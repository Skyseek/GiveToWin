<?php

class Admin_AuthController extends Zend_Controller_Action
{
	// ====================================================================
	//
	//  Properties
	//
	// ====================================================================
	
	protected $_userService;


	// ====================================================================
	//
	//  Constructor
	//
	// ====================================================================
	
	
	public function init() 
	{
		$this->_userService = new GTW_Service_User();
	}


	// ====================================================================
	//
	//  Action Methods
	//
	// ====================================================================


	public function indexAction()
	{
		// action body
	}

	public function loginAction()
	{
		// action body
	}

	public function deniedAction()
	{
		
	}

	public function logoutAction()
	{
		$this->_userService->stopSession();
		$this->_forward('login');
	}
}