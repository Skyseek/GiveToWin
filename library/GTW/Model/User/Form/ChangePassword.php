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
class GTW_Model_User_Form_ChangePassword extends Skyseek_Form_UniForm 
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
		$this->_user = $user;
	}
	
	/**
	 * @return GTW_Model_User User
	 */
	public function getUser() 
	{
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
			'value'	=> 'changePassword'
		));

		$this->addElement('password', 'password', array(
			'label'      => 'Password:',
			'required'   => true,
			'filters'    => array('StringTrim'),
			'validators' => array(
				new Zend_Validate_StringLength(array('min'=>6))
			)
		));


		$this->addElement('password', 'repass', array(
			'label'      => 'Password again:',
			'required'   => true,
			'filters'    => array('StringTrim'),
			'validators' => array(
				array('identical', false, array('token' => 'password'))
			)
		));


		// Add the submit button
		$this->addElement('submit', 'submit', array(
			'ignore'   => true,
			'label'    => 'Change Password',
		));


		$this->createElement('Submit', 'submit', array(
			'label'=>'Save!',
			'class'=>'primaryAction'
		));

	}
}
