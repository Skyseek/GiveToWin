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
 * Offer Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Offer_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Offer
	// ----------------------------------
	

	/**
	 * @var GTW_Model_Offer Offer
	 */
	protected $_offer;
	
	/**
	 * @param GTW_Model_Offer $offer Offer
	 */
	public function setOffer(GTW_Model_Offer $offer) 
	{
		$this->populate($offer->toArray(true, true));

		$this->_offer = $offer;
	}
	
	/**
	 * @return GTW_Model_Offer Offer
	 */
	public function getOffer() 
	{
		if(!$this->_offer) 
			$this->_offer = new GTW_Model_Offer();

		$this->_offer->title 		= $this->_titleElement->getValue();
		$this->_offer->description 	= $this->_descriptionElement->getValue();
		$this->_offer->value 		= $this->_valueElement->getValue();
		$this->_offer->minimum 		= $this->_minimumElement->getValue();
		$this->_offer->status 		= $this->getSelectedStatus();
		$this->_offer->company 		= $this->getSelectedCompany();

		return $this->_offer;
	}

	public function getSelectedStatus()
	{
		$mapper		= GTW_Model_Offer_Status_Mapper::getInstance();
		$statusId	= $this->_statusElement->getValue();

		return $mapper->getStatus($statusId);
	}

	public function getSelectedCompany()
	{
		$mapper		= GTW_Model_Company_Mapper::getInstance();
		$companyId	= $this->_companyElement->getValue();

		return $mapper->getCompany($companyId);
	}

	public function setSelectedCompany(GTW_Model_Company $company)
	{
		$this->_companyElement->setValue($company->id);
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

		$this->removeDecorator('Form');
	}

	// ====================================================================
	//
	// 	Form Tabs
	//
	// ====================================================================

	private $_profileTabPage1;
	private $_profileTabPage2;

	private function _initTabs() 
	{
		$this->_initProfilePage1Tab();
		$this->_initProfilePage2Tab();
	}

	private function _initProfilePage1Tab() 
	{

		$form = new Zend_Form_SubForm();
		$form->addElements(array(
			$this->_titleElement,
			$this->_companyElement,
			$this->_statusElement,
			$this->_minimumElement,
			$this->_valueElement
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
			$this->_descriptionElement
		));

		$form->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-description', 'class'=>'tabs-content'))
		));

		$this->_profileTabPage2 = $form;
	}




	// ====================================================================
	//
	// 	Elements
	//
	// ====================================================================
	
	private $_titleElement;
	private $_descriptionElement;
	private $_valueElement;
	private $_minimumElement;
	private $_statusElement;
	private $_companyElement;

	private function _initElements() 
	{
		$this->_initTitleElement();
		$this->_initDescriptionElement();
		$this->_initCostElement();
		$this->_initGoalElement();
		$this->_initStatusElement();
		$this->_initCompanyElement();
	}

	private function _initTitleElement() 
	{
		$element = $this->createElement('text', 'title')
			->setLabel("Name")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_titleElement = $element;
	}

	private function _initCostElement() 
	{
		$element = $this->createElement('text', 'value')
			->setLabel("Value")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_valueElement = $element;
	}

	private function _initGoalElement() 
	{
		$element = $this->createElement('text', 'minimum')
			->setLabel("Minimum")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_minimumElement = $element;
	}

	private function _initDescriptionElement() 
	{
		$element = $this->createElement('textarea', 'description')
			->setLabel("Description")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_descriptionElement = $element;
	}


	private function _initStatusElement() 
	{
		$element = $this->createElement('select', 'status_id')
			->setLabel("Status")
			->setAttrib('class', 'full-width')
			->setRequired();

		$statusTypes = GTW_Model_Offer_Status_Mapper::getInstance()->getCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}


		$this->_statusElement = $element;
	}

	private function _initCompanyElement() 
	{
		$element = $this->createElement('select', 'company_id')
			->setLabel("Company")
			->setAttrib('class', 'full-width')
			->setRequired();

		$charities = GTW_Model_Company_Mapper::getInstance()->getCollection();
		foreach($charities as $company) {
			$element->addMultiOptions(array($company->id => $company->name));
		}


		$this->_companyElement = $element;
	}
}
