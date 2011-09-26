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
 * Contact Message Form
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Contact_Message_Form extends Skyseek_Form_UniForm 
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
	protected $_message;

	
	/**
	 * @return GTW_Model_City_Suggestion
	 */
	public function getMessage() 
	{
		if(!$this->_message instanceof GTW_Model_Contact_Message)
			$this->_message = new GTW_Model_Contact_Message();


		$this->_message->name 		= $this->_nameElement->getValue();
		$this->_message->email 		= $this->_emailElement->getValue();
		$this->_message->message 	= $this->_messageElement->getValue();

		return $this->_message;
	}    

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	

	protected $_nameElement;
	protected $_emailElement;
	protected $_messageElement;


	public function init() {
		$this->setOptions(array('title'=>'Contact Us'));
		$this->setAction('/info/contact');
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

		$this->_messageElement = $this->createElement('Textarea', 'message', array(
			'description'=>'Comments, Suggestions, Complaints, etc',
			'label'=>'Message:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>20))
			)
		));

		$this->createElement('Submit', 'submit', array(
			'label'=>'Send Message!',
			'class'=>'primaryAction'
		));
	}
}