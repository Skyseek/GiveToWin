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
 * User Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	User
	// ----------------------------------
	

	/**
	 * @var GTW_Model_User User
	 */
	protected $_user;
	
	/**
	 * @param GTW_Model_User $user User
	 */
	public function setUser(GTW_Model_User $user) 
	{
		$this->populate($user->toArray(true, true));
		$this->_user = $user;
	}
	
	/**
	 * @return GTW_Model_User User
	 */
	public function getUser() 
	{
		return $this->_user;
	}


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
    public function  __construct($options = null) 
    {
		parent::__construct($options);
		$this->_initForm();
	}

	private function _initForm() 
	{
		$this->_initElements();
		$this->_initTabs();

		$this->addSubForm($this->_profileTab, 'profileTab');

		$this->removeDecorator('Form');
	}

	// ====================================================================
	//
	// 	Form Tabs
	//
	// ====================================================================

	private $_profileTab;

	private function _initTabs() 
	{
		$this->_initProfileTab();
	}

	private function _initProfileTab() 
	{

		$form = new Zend_Form_SubForm();
		$form->addElements(array(
			$this->_firstNameElement,
			$this->_lastNameElement,
			$this->_emailElement,
			$this->_statusElement,
			$this->_roleElement,
			$this->_genderElement,
			//$this->_birthDateElement
		));

		$form->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-settings', 'class'=>'tabs-content'))
		));

		$this->_profileTab = $form;
	}


	// ====================================================================
	//
	// 	Elements
	//
	// ====================================================================
	
	private $_firstNameElement;
	private $_lastNameElement;
	private $_emailElement;
	private $_statusElement;
	private $_roleElement;
	private $_genderElement;
	private $_birthDateElement;

	private function _initElements() 
	{
		$this->_initFirstNameElement();
		$this->_initLastNameElement();
		$this->_initEmailElement();
		$this->_initStatusElement();
		$this->_initRoleElement();
		$this->_initGenderElement();
		$this->_initBirthDateElement();
	}

	private function _initFirstNameElement() 
	{
		$element = $this->createElement('text', 'first_name')
			->setLabel("First Name")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_firstNameElement = $element;
	}

	private function _initLastNameElement() 
	{
		$element = $this->createElement('text', 'last_name')
			->setLabel("Last Name")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_lastNameElement = $element;
	}


	private function _initEmailElement() 
	{
		$element = $this->createElement('text', 'email')
			->setLabel("Email")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_emailElement = $element;
	}


	private function _initStatusElement() 
	{
		$element = $this->createElement('select', 'status')
			->setLabel("Status")
			->setAttrib('class', 'full-width')
			->setRequired();

		$statusTypes = GTW_Model_User_Status_Mapper::getInstance()->getStatusCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}


		$this->_statusElement = $element;
	}


	private function _initRoleElement() 
	{	
		
		$element = $this->createElement('select', 'role')
			->setLabel("User Type")
			->setAttrib('class', 'full-width')
			->setRequired();
		
		$roleTypes = GTW_Model_User_Role_Mapper::getInstance()->getRoleCollection();
		foreach($roleTypes as $roleType) {
			$element->addMultiOptions(array($roleType->id=>$roleType->role));
		}

		$this->_roleElement = $element;
	}


	private function _initGenderElement() 
	{
		$element = $this->createElement('select', 'gender')
			->setLabel("Gender")
			->setAttrib('class', 'full-width')
			->setRequired();
		
		$element->addMultiOptions(array(
			'Female'=>'Female',
			'Male'=>'Male'
		));
		
		$this->_genderElement = $element;
	}

	private function _initBirthDateElement() 
	{
		$element = $this->createElement('text', 'birth_date')
			->setLabel("Birth Date")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_birthDateElement = $element;
	}
}
