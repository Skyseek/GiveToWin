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
 * User Form -> Login Page.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User_Form_Login extends Skyseek_Form_UniForm 
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
		if(!$this->_user instanceof GTW_Model_User)
			$this->_user = new GTW_Model_User();


		$this->_user->password 	= $this->getElement('password')->getValue();
		$this->_user->email 	= $this->getElement('email')->getValue();

		return $this->_user;
	}    

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	

	public function init() {
		$this->setOptions(array('title'=>'User Login'));
		$this->setAction('/User/Login');
		$this->setMethod('POST');


		$this->createElement('Text', 'email', array(
			'description'=>'Enter Email Address',
			'label'=>'Email:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_EmailAddress()
			)
		));

		$this->createElement('Password', 'password', array(
			'description'=>'Super Secret Password',
			'label'=>'Password:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>6))
			)
		));


//		$this->createElement('Checkbox', 'keep_logged_in', array(
//			'title'=>'Keep me logged in',
//		));

		$this->createElement('Submit', 'submit', array(
			'label'=>'Login!',
			'class'=>'primaryAction'
		));


		$this->createElement('Button', 'not_registered', array(
			'label' => 'Not Registered Yet?',
			'class' => 'secondaryAction',
			'click' => 'window.location="/User/Register"'
		));

		$this->createElement('Button', 'forgot_password', array(
			'label' => 'Forgot User/Password?',
			'class' => 'secondaryAction',
			'click' => 'window.location="/User/Forgot-Password"'
		));



	}
}