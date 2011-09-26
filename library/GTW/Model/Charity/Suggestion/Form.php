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
 * Charity SuggestionForm
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Charity_Suggestion_Form extends Skyseek_Form_UniForm 
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
	 * @var GTW_Model_Charity_Suggestion
	 */
	protected $_suggestion;

	
	/**
	 * @return GTW_Model_Charity_Suggestion
	 */
	public function getSuggestion() 
	{
		if(!$this->_suggestion instanceof GTW_Model_Charity_Suggestion)
			$this->_suggestion = new GTW_Model_Charity_Suggestion();


		$this->_suggestion->name 		= $this->_nameElement->getValue();
		$this->_suggestion->email 		= $this->_emailElement->getValue();
		$this->_suggestion->message 	= $this->_messageElement->getValue();

		$this->_suggestion->charityName 	= $this->_charityNameElement->getValue();
		$this->_suggestion->charityWebsite	= $this->_charityWebsiteElement->getValue();
		$this->_suggestion->charityType		= $this->_charityTypeElement->getValue();

		return $this->_suggestion;
	}    

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	

	protected $_nameElement;
	protected $_emailElement;
	protected $_messageElement;
	protected $_charityNameElement;
	protected $_charityWebsiteElement;
	protected $_charityTypeElement;


	public function init() {
		$this->setOptions(array('title'=>'Suggest Non-Profit / Charity'));
		$this->setAction('/suggest/non-profit');
		$this->setMethod('POST');


		$this->_nameElement = $this->createElement('Text', 'name', array(
			'description'=>'Your Full Name.',
			'label'=>'Name:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>3))
			)
		));

		$this->_emailElement = $this->createElement('Text', 'email', array(
			'description'=>'Your Valid Email.',
			'label'=>'Email:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_EmailAddress()
			)
		));

		$this->_charityNameElement = $this->createElement('Text', 'charityName', array(
			'description'=>'Try to give the full legal name, if avaialable to you.',
			'label'=>'Name of Organization:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>3))
			)
		));

		$this->_charityTypeElement = $this->createElement('Text', 'charityType', array(
			'description'=>'',
			'label'=>'Type of Charity:',
			'required'=>true,
			'validators'=>array(
				
			)
		));

		$this->_charityWebsiteElement = $this->createElement('Text', 'charityWebsite', array(
			'description'=>'',
			'label'=>'Organization\'s Website:',
			'required'=>true,
			'validators'=>array(
			)
		));

		$this->_messageElement = $this->createElement('Textarea', 'message', array(
			'description'=>'Why do you think we should help raise money for this organization?',
			'label'=>'Message:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>20))
			)
		));

		$this->createElement('Submit', 'submit', array(
			'label'=>'Submit Suggestion!',
			'class'=>'primaryAction'
		));
	}
}