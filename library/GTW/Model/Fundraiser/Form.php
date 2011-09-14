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
 * Fundraiser Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Fundraiser_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Fundraiser
	// ----------------------------------
	

	/**
	 * @var GTW_Model_Fundraiser Fundraiser
	 */
	protected $_fundraiser;
	
	/**
	 * @param GTW_Model_Fundraiser $fundraiser Fundraiser
	 */
	public function setFundraiser(GTW_Model_Fundraiser $fundraiser) 
	{
		$this->populate($fundraiser->toArray(true, true));

		$this->_fundraiser = $fundraiser;
	}
	
	/**
	 * @return GTW_Model_Fundraiser Fundraiser
	 */
	public function getFundraiser() 
	{
		if(!$this->_fundraiser) 
			$this->_fundraiser = new GTW_Model_Fundraiser();

		$this->_fundraiser->title 		= $this->_titleElement->getValue();
		$this->_fundraiser->description = $this->_descriptionElement->getValue();
		$this->_fundraiser->cost 		= $this->_costElement->getValue();
		$this->_fundraiser->goal 		= $this->_goalElement->getValue();
		$this->_fundraiser->status 		= $this->getSelectedStatus();
		$this->_fundraiser->charity 	= $this->getSelectedCharity();

		return $this->_fundraiser;
	}

	public function getSelectedStatus()
	{
		$mapper		= GTW_Model_Fundraiser_Status_Mapper::getInstance();
		$statusId	= $this->_statusElement->getValue();

		return $mapper->getStatus($statusId);
	}

	public function getSelectedCharity()
	{
		$mapper		= GTW_Model_Charity_Mapper::getInstance();
		$charityId	= $this->_charityElement->getValue();

		return $mapper->getCharity($charityId);
	}

	public function setSelectedCharity(GTW_Model_Charity $charity)
	{
		$this->_charityElement->setValue($charity->id);
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
			$this->_charityElement,
			$this->_statusElement,
			$this->_goalElement,
			$this->_costElement
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
	private $_costElement;
	private $_goalElement;
	private $_statusElement;
	private $_charityElement;

	private function _initElements() 
	{
		$this->_initTitleElement();
		$this->_initDescriptionElement();
		$this->_initCostElement();
		$this->_initGoalElement();
		$this->_initStatusElement();
		$this->_initCharityElement();
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
		$element = $this->createElement('text', 'cost')
			->setLabel("Cost")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_costElement = $element;
	}

	private function _initGoalElement() 
	{
		$element = $this->createElement('text', 'goal')
			->setLabel("Goal")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_goalElement = $element;
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

		$statusTypes = GTW_Model_Fundraiser_Status_Mapper::getInstance()->getCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}


		$this->_statusElement = $element;
	}

	private function _initCharityElement() 
	{
		$element = $this->createElement('select', 'charity_id')
			->setLabel("Charity")
			->setAttrib('class', 'full-width')
			->setRequired();

		$charities = GTW_Model_Charity_Mapper::getInstance()->getCollection();
		foreach($charities as $charity) {
			$element->addMultiOptions(array($charity->id => $charity->name));
		}


		$this->_charityElement = $element;
	}
}
