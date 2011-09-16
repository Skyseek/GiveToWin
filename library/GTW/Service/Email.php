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
 * Email
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Email {

    protected static $_instance;

	/**
	 * @return GTW_Service_Email
	 */
	public static function getInstance() {
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	public function getAllTemplates() {
		return GTW_Model_Email_Template_Mapper::getInstance()->getCollection();
	}

	public function getTemplate($id) 
	{
		return GTW_Model_Email_Template_Mapper::getInstance()->getTemplate($id);
	}

	public function getTemplateByName($name) 
	{
		$request = new Skyseek_Model_Entity_Collection_Request(1, 1);
		$request->addFilter('name', '=', $name);

		return GTW_Model_Email_Template_Mapper::getInstance()->getCollection($request)->current();
	}

	/**
	 *
	 * @param GTW_Model_Email_Template $template
	 * @return GTW_Model_Email_Template_Form
	 */
	public function getTemplateForm(GTW_Model_Email_Template $template) {
		$form = GTW_Model_Email_Template_Mapper::getInstance()->getForm();
		$form->setTemplate($template);
		
		return $form;
	}

	public function save(GTW_Model_Email_Template $template) {
		return GTW_Model_Email_Template_Mapper::getInstance()->save($template);
	}

	public function queueEmail(GTW_Model_Email $email)
	{
		return GTW_Model_Email_Mapper::getInstance()->save($email);
	}
}
