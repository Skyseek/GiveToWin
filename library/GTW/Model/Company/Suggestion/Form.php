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
 * Company SuggestionForm
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Company_Suggestion_Form extends Skyseek_Form_UniForm 
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
	 * @var GTW_Model_Company_Suggestion
	 */
	protected $_suggestion;

	
	/**
	 * @return GTW_Model_Company_Suggestion
	 */
	public function getSuggestion() 
	{
		if(!$this->_suggestion instanceof GTW_Model_Company_Suggestion)
			$this->_suggestion = new GTW_Model_Company_Suggestion();


		$this->_suggestion->name 		= $this->_nameElement->getValue();
		$this->_suggestion->email 		= $this->_emailElement->getValue();
		$this->_suggestion->message 	= $this->_messageElement->getValue();

		$this->_suggestion->companyName 	= $this->_companyNameElement->getValue();
		$this->_suggestion->companyWebsite	= $this->_companyWebsiteElement->getValue();
		$this->_suggestion->companyType		= $this->_companyTypeElement->getValue();

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
	protected $_companyNameElement;
	protected $_companyWebsiteElement;
	protected $_companyTypeElement;


	public function init() {
		$this->setOptions(array('title'=>'Suggest Merchant / Company'));
		$this->setAction('/suggest/merchant');
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

		$this->_companyNameElement = $this->createElement('Text', 'companyName', array(
			'description'=>'Try to give the full legal name, if avaialable to you.',
			'label'=>'Name of Organization:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>3))
			)
		));

		$this->_companyTypeElement = $this->createElement('Text', 'companyType', array(
			'description'=>'',
			'label'=>'Type of Company:',
			'required'=>true,
			'validators'=>array(
				
			)
		));

		$this->_companyWebsiteElement = $this->createElement('Text', 'companyWebsite', array(
			'description'=>'',
			'label'=>'Organization\'s Website:',
			'required'=>true,
			'validators'=>array(
			)
		));

		$this->_messageElement = $this->createElement('Textarea', 'message', array(
			'description'=>'Why do you think we should partner with this business?',
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