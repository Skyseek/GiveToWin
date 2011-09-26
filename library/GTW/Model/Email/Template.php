<?php
/**
 * Givetowin.org License, Version 1.0
 *
 * You may not modify or use this file except with written permission
 * from Give to Win, Inc.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND Give to Win HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 */






/**
 * Email Template
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Email_Template extends Skyseek_Model_Entity 
{
    public $id;
	public $name;
	public $description;
	public $subject;
	public $text_body;
	public $html_body;
	public $from_email;
	public $from_alias;

	protected $_variables = array();

	public function assign($name, $value)
	{
		$this->_variables[$name] = new TemplateVarProxy($value);
	}

	/**
	 * Renders template into GTW_Model_Email object.
	 *
	 * @return GTW_Model_Email
	 */
	public function render(GTW_Model_User $user)
	{
		return new GTW_Model_Email(array(
			'subject'		=> $this->_parseMarkDown($this->subject),
			'text_content'	=> $this->_parseMarkDown($this->text_body),
			'html_content'	=> $this->_getHtmlBody(),
			'from_email'	=> $this->from_email,
			'from_alias'	=> $this->from_alias,
			'user'			=> $user,
			'to_email'		=> $user->email,
			'to_alias'		=> $user->alias,
			'time_created'	=> Zend_Date::now()->get('c'),
			'emailTemplate'	=> $this,
		));
	}

	protected function _getHtmlBody() 
	{
		$layout = new Zend_Layout();
		$layout->setLayout('email');
		$layout->setLayoutPath( APPLICATION_PATH . '/modules/default/layouts/scripts/');
		$layout->content = $this->_parseMarkDown($this->html_body);
		
		return  $layout->render();
	}

	protected function _parseMarkDown($markDownString)
	{
		extract($this->_variables);

		// ----------------------------------
		// 	Dumb down html entities
		// ----------------------------------
		
		$pattern = '/%%(.*)-&gt;(.*)-&gt;(.*)%%/';
		$replacement = '%%$${1}->${2}->${3}%%';
		$markDownString =  preg_replace($pattern, $replacement, $markDownString);

		$pattern = '/%%(.*)-&gt;(.*)%%/';
		$replacement = '%%$${1}->${2}%%';
		$markDownString =  preg_replace($pattern, $replacement, $markDownString);

		// ----------------------------------
		// 	Replace %% with php langs
		// ----------------------------------

		$pattern = '/%%(.*)->(.*)->(.*)%%/';
		$replacement = '<?php echo isset($${1}) ? $${1}->${2}->${3} : "${1}->${2}->${3}"; ?>';
		$markDownString =  preg_replace($pattern, $replacement, $markDownString);

		$pattern = '/%%(.*)->(.*)%%/';
		$replacement = '<?php echo isset($${1}) ? $${1}->${2} : "${1}->${2}"; ?>';
		$markDownString =  preg_replace($pattern, $replacement, $markDownString);

		$pattern = '/%%([a-z,A-Z]*)%%/';
		$replacement = '<?php echo isset($${1}) ? $${1} : "${1}"; ?>';
		$markDownString = preg_replace($pattern, $replacement, $markDownString);

		$markDownString = str_replace("?>\n", "?> \n", $markDownString);
		$markDownString = str_replace("?>\r\n", "?> \n", $markDownString);
	
		ob_start();
		eval('?>' . $markDownString);
		$markDownString = ob_get_contents();
		ob_clean();

		return $markDownString;
	}
}

class TemplateVarProxy
{
	protected $_proxiedVar;

	public function __construct($varible)
	{
		$this->_proxiedVar = $varible;
	}

	public function __get($propertyName) 
	{
		if(property_exists($this->_proxiedVar, $propertyName))
			return $this->_value($this->_proxiedVar->$propertyName);
		
		$getterFunction = 'get' . ucwords($propertyName);
		
		if(method_exists($this->_proxiedVar, $getterFunction))
			return $this->_value($this->_proxiedVar->$getterFunction());
		
		return $propertyName;
	}

	protected function _value($varible)
	{
		if(is_object($varible)) {
			return new TemplateVarProxy($varible);
		} else {
			return $varible;
		}
	}
}
