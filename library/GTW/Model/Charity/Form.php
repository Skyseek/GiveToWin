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
 * Charity Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Charity_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Charity
	// ----------------------------------
	

	/**
	 * @var GTW_Model_Charity Charity
	 */
	protected $_charity;
	
	/**
	 * @param GTW_Model_Charity $charity Charity
	 */
	public function setCharity(GTW_Model_Charity $charity) 
	{
		$this->populate($charity->toArray(true, true));
		$this->_charity = $charity;
	}
	
	/**
	 * @return GTW_Model_Charity Charity
	 */
	public function getCharity() 
	{
		if(!$this->_charity) 
			$this->_charity = new GTW_Model_Charity();

		$this->_charity->name			= $this->_nameElement->getValue();
		$this->_charity->email			= $this->_emailElement->getValue();
		$this->_charity->phone			= $this->_phoneElement->getValue();
		$this->_charity->website		= $this->_websiteElement->getValue();
		$this->_charity->status_id		= $this->_statusElement->getValue();
		$this->_charity->work			= $this->_workElement->getValue();
		$this->_charity->mission		= $this->_missionElement->getValue();

		return $this->_charity;
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
		$this->addSubForm($this->_profileTabPage2, 'profileTabPage2');
		$this->addSubForm($this->_profileTabPage3, 'profileTabPage3');

		$this->removeDecorator('Form');
	}

	// ====================================================================
	//
	// 	Form Tabs
	//
	// ====================================================================

	private $_profileTabPage1;
	private $_profileTabPage2;
	private $_profileTabPage3;

	private function _initTabs() 
	{
		$this->_initProfilePage1Tab();
		$this->_initProfilePage2Tab();
		$this->_initProfilePage3Tab();
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

	private function _initProfilePage2Tab() 
	{

		$form = new Zend_Form_SubForm();
		$form->addElements(array(
			$this->_workElement
		));

		$form->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-settings-pg2', 'class'=>'tabs-content'))
		));

		$this->_profileTabPage2 = $form;
	}

	private function _initProfilePage3Tab() 
	{

		$form = new Zend_Form_SubForm();
		$form->addElements(array(
			$this->_missionElement
		));

		$form->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-settings-pg3', 'class'=>'tabs-content'))
		));

		$this->_profileTabPage3 = $form;
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
	private $_workElement;
	private $_missionElement;

	private function _initElements() 
	{
		$this->_initNameElement();
		$this->_initEmailElement();
		$this->_initPhoneElement();
		$this->_initWebsiteElement();
		$this->_initWorkElement();
		$this->_initMissionElement();
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


	private function _initWorkElement() 
	{
		$element = $this->createElement('textarea', 'work')
			->setLabel("Charity's Work")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_workElement = $element;
	}


	private function _initMissionElement() 
	{
		$element = $this->createElement('textarea', 'mission')
			->setLabel("Charity's Mission")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_missionElement = $element;
	}


	private function _initStatusElement() 
	{
		$element = $this->createElement('select', 'status')
			->setLabel("Status")
			->setAttrib('class', 'full-width')
			->setRequired();

		$statusTypes = GTW_Model_Charity_Status_Mapper::getInstance()->getCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}


		$this->_statusElement = $element;
	}
}
