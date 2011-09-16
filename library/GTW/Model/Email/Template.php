<?php
/** 
 * Givetowin.org License, Version 1.0
 * 
 * You may not modify or use this file except with written permission 
 * from Givetowin.org.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Givetowin.org
 */






/**
 * Template
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
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
		$this->_variables[$name] = $value;
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

		$pattern = '/%%(.*)-&gt;(.*)%%/';
		$replacement = '<?php echo $${1}->${2}; ?>';
		$markDownString =  preg_replace($pattern, $replacement, $markDownString);

		$pattern = '/%%([a-z,A-Z]*)%%/';
		$replacement = '<?php echo $${1}; ?>';
		$markDownString = preg_replace($pattern, $replacement, $markDownString);
	
		ob_start();
		eval('?>' . $markDownString);
		$markDownString = ob_get_contents();
		ob_clean();

		return $markDownString;
	}
}
