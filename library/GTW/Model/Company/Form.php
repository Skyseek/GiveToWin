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
 * Company Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Company_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Company
	// ----------------------------------
	

	/**
	 * @var GTW_Model_Company Company
	 */
	protected $_company;
	
	/**
	 * @param GTW_Model_Company $company Company
	 */
	public function setCompany(GTW_Model_Company $company) 
	{
		$this->populate($company->toArray(true, true));
		$this->_company = $company;
	}
	
	/**
	 * @return GTW_Model_Company Company
	 */
	public function getCompany() 
	{
		if(!$this->_company) 
			$this->_company = new GTW_Model_Company();

		$this->_company->name = $this->_nameElement->getValue();
		$this->_company->email = $this->_emailElement->getValue();
		$this->_company->phone = $this->_phoneElement->getValue();
		$this->_company->website = $this->_websiteElement->getValue();
		$this->_company->status_id = $this->_statusElement->getValue();

		return $this->_company;
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

		$this->addSubForm($this->_profileTabPage1, 'profileTabPage1');

		$this->removeDecorator('Form');
	}

	// ====================================================================
	//
	// 	Form Tabs
	//
	// ====================================================================

	private $_profileTabPage1;

	private function _initTabs() 
	{
		$this->_initProfilePage1Tab();
	}

	private function _initProfilePage1Tab() 
	{

		$form = new Zend_Form_SubForm();
		$form->addElements(array(
			$this->_nameElement,
			$this->_statusElement,
			$this->_emailElement,
			$this->_phoneElement,
			$this->_websiteElement
		));

		$form->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-settings', 'class'=>'tabs-content'))
		));

		$this->_profileTabPage1 = $form;
	}




	// ====================================================================
	//
	// 	Elements
	//
	// ====================================================================
	
	private $_nameElement;
	private $_emailElement;
	private $_phoneElement;
	private $_websiteElement;
	private $_statusElement;

	private function _initElements() 
	{
		$this->_initNameElement();
		$this->_initEmailElement();
		$this->_initPhoneElement();
		$this->_initWebsiteElement();
		$this->_initStatusElement();
	}

	private function _initNameElement() 
	{
		$element = $this->createElement('text', 'name')
			->setLabel("Name")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_nameElement = $element;
	}

	private function _initEmailElement() 
	{
		$element = $this->createElement('text', 'email')
			->setLabel("Email")
			->setAttrib('class', 'full-width')
			->setRequired()
			->addValidator(new Zend_Validate_EmailAddress());

		$this->_emailElement = $element;
	}

	private function _initPhoneElement() 
	{
		$element = $this->createElement('text', 'phone')
			->setLabel("Phone")
			->setAttrib('class', 'full-width')
			->setRequired()
			->addValidator(new Zend_Validate_StringLength(array('min'=>7, 'max'=>10)));

		$this->_phoneElement = $element;
	}

	private function _initWebsiteElement() 
	{
		$element = $this->createElement('text', 'website')
			->setLabel("Website")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_websiteElement = $element;
	}


	private function _initStatusElement() 
	{
		$element = $this->createElement('select', 'status_id')
			->setLabel("Status")
			->setAttrib('class', 'full-width')
			->setRequired();

		$statusTypes = GTW_Model_Company_Status_Mapper::getInstance()->getCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}


		$this->_statusElement = $element;
	}
}
