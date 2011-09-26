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
 * Suggest City Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City_Suggestion_Form extends Skyseek_Form_UniForm 
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Suggestoin
	// ----------------------------------
	

	/**
	 * @var GTW_Model_City_Suggestion
	 */
	protected $_city;

	/**
	 * @param GTW_Model_City $city City
	 */
	public function setSuggestion(GTW_Model_City_Suggestion $city) 
	{
		$this->populate($city->toArray(true, true));
		$this->_city = $city;		
	}

	
	/**
	 * @return GTW_Model_City_Suggestion
	 */
	public function getSuggestion() 
	{
		if(!$this->_city instanceof GTW_Model_City_Suggestion)
			$this->_city = new GTW_Model_City_Suggestion();


		$this->_city->city 		= $this->_cityNameElement->getValue();
		$this->_city->state_id 	= $this->_stateElement->getValue();
		$this->_city->status_id = $this->_commentElement->getValue();

		return $this->_city;
	}    

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	

	protected $_cityNameElement;
	protected $_stateElement;
	protected $_commentElement;


	public function init() {
		$this->setOptions(array('title'=>'Suggest City'));
		$this->setAction('/Suggest/City');
		$this->setMethod('POST');


		$this->_cityNameElement = $this->createElement('Text', 'city', array(
			'description'=>'Enter City Name.',
			'label'=>'City Name:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>3))
			)
		));

		$this->_stateElement = $this->createElement('Select', 'state_id', array(
			'description'=>'State of the City.',
			'label'=>'State:',
			'required'=>true,
			'validators'=>array(
				
			)
		));

		$states = GTW_Model_State_Mapper::getInstance()->getCollection();
		foreach($states as $state) {
			$this->_stateElement->addMultiOptions(array($state->id=>$state->state));
		}

		$this->_commentElement = $this->createElement('Textarea', 'comments', array(
			'description'=>'Any comments you\'d like to add?',
			'label'=>'Comments:',
			'required'=>false,
			'validators'=>array(
				
			)
		));

		$this->createElement('Submit', 'submit', array(
			'label'=>'Login!',
			'class'=>'primaryAction'
		));
	}
}