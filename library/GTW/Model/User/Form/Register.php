<?php
////////////////////////////////////////////////////////////////////////////////
//
// Give To Win
// Copyright © 2011 Give To Win
// All Rights Reserved.
//
// NOTICE:
//
// Give To Win does NOT permit you to use, modify, and/or distribute this file.
//
////////////////////////////////////////////////////////////////////////////////


class GTW_Model_User_Form_Register extends Skyseek_Form_UniForm 
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


		$this->_user->first_name 	= $this->getElement('first_name')->getValue();
		$this->_user->last_name 	= $this->getElement('last_name')->getValue();
		$this->_user->password 		= $this->getElement('password')->getValue();
		$this->_user->email 		= $this->getElement('email')->getValue();

		return $this->_user;
	}    

	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	

	public function init() {
		$this->setOptions(array('title'=>'User Registration'));
		$this->setAction('/User/Register');
		$this->setMethod('POST');

        // Set the method for the display form to POST
        $this->setMethod('post');

        $this->addElement('text', 'first_name', array(
            'label'      => 'First Name:',
			'description'=>'Please Enter your first name.',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                
            )
        ));


        $this->addElement('text', 'last_name', array(
            'label'      => 'Last Name:',
			'description'=>'Please Enter your last name.',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(

            )
        ));

       	$this->createElement('Text', 'email', array(
			'title'=>'Enter Email',
			'description'=>'Use a valid email addresss. You\'ll need it to confirm your account!',
			'label'=>'Email Address:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_EmailAddress()
			)
		));


        $this->createElement('Password', 'password', array(
			'title'=>'Super Secret Password',
			'description'=>'Enter a VERY Secure Password,<br /> And Shhh! Don\'t tell anybody...',
			'label'=>'Password:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_StringLength(array('min'=>6))
			)
		));

		$this->createElement('Password', 'password_confirm', array(
			'title'=>'Super Secret Password #2',
			'description'=>'You need to re-type in your password to confirm we got it right the first time!',
			'label'=>'Re-Type Password:',
			'required'=>true,
			'validators'=>array(
				new Zend_Validate_Identical('password')
			)
		));

		$this->createElement('Button', 'not_registered', array(
			'label' => 'Already a Member?',
			'class' => 'secondaryAction',
			'click' => 'window.location="/User/Login"'
		));

		$this->createElement('Submit', 'submit', array(
			'label'=>'Register!',
			'class'=>'primaryAction'
		));

    }
}