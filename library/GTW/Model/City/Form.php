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
 * City Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City_Form extends Zend_Form 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	City
	// ----------------------------------
	

	/**
	 * @var GTW_Model_City City
	 */
	protected $_city;
	
	/**
	 * @param GTW_Model_City $city City
	 */
	public function setCity(GTW_Model_City $city) 
	{
		$this->populate($city->toArray(true, true));
		$this->_city = $city;		
	}
	
	/**
	 * @return GTW_Model_City City
	 */
	public function getCity() 
	{
		if(!$this->_city) 
			$this->_city = new GTW_Model_City();

		$this->_city->city 		= $this->_cityNameElement->getValue();
		$this->_city->state_id 	= $this->_stateElement->getValue();
		$this->_city->status_id = $this->_statusElement->getValue();

		return $this->_city;
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
			$this->_stateElement,
			$this->_cityNameElement,
			$this->_statusElement
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
	
	private $_cityNameElement;
	private $_stateElement;
	private $_statusElement;

	private function _initElements() 
	{
		$this->_initStateElement();
		$this->_initCityNameElement();
		$this->_initStatusElement();
	}

	private function _initCityNameElement() 
	{
		$element = $this->createElement('text', 'city')
			->setLabel("City Name")
			->setAttrib('class', 'full-width')
			->setRequired();

		$this->_cityNameElement = $element;
	}

	private function _initStateElement() 
	{	
		
		$element = $this->createElement('select', 'state_id')
			->setLabel("State")
			->setAttrib('class', 'full-width')
			->setRequired();
		
		$states = GTW_Model_State_Mapper::getInstance()->getCollection();
		foreach($states as $state) {
			$element->addMultiOptions(array($state->id=>$state->state));
		}

		$this->_stateElement = $element;
	}

	private function _initStatusElement() 
	{
		$element = $this->createElement('select', 'status_id')
			->setLabel("Status")
			->setAttrib('class', 'full-width')
			->setRequired();

		$statusTypes = GTW_Model_City_Status_Mapper::getInstance()->getCollection();
		foreach($statusTypes as $statusType) {
			$element->addMultiOptions(array($statusType->id=>$statusType->status));
		}

		$this->_statusElement = $element;
	}
}
