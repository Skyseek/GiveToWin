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
 * User Form -> Account Page.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User_Form_EditAccount extends Skyseek_Form_UniForm 
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
		$this->_user->first_name 	= $this->getElement('first_name')->getValue();
		$this->_user->last_name 	= $this->getElement('last_name')->getValue();
		$this->_user->email 		= $this->getElement('email')->getValue();

		return $this->_user;
	}


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	public function init()
	{
		// Set the method for the display form to POST
		$this->setMethod('post');

		$this->addElement('hidden', 'action', array(
			'value'	=> 'editAccount'
		));

		$this->addElement('text', 'first_name', array(
			'label'      => 'First Name:',
			'required'   => true,
			'filters'    => array('StringTrim'),
			'validators' => array(
				
			)
		));

		$this->addElement('Text', 'last_name', array(
			'label'      => 'Last Name:',
			'required'   => true,
			'filters'    => array('StringTrim'),
			'validators' => array(

			)
		));

		$this->addElement('Text', 'email', array(
			'label'			=>'Email Address:',
			'required'		=> true,
			'filters'		=> array('StringTrim'),
			'validators'	=> array(
				new Zend_Validate_EmailAddress()
			)
		));


		$this->createElement('Submit', 'submit', array(
			'label'=>'Save!',
			'class'=>'primaryAction'
		));

	}
}
