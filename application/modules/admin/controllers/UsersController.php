<?php

class Admin_UsersController extends Zend_Controller_Action
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	protected $_userService;


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	
	public function init() 
	{
		$this->_userService = new GTW_Service_User();
	}


	// ====================================================================
	//
	// 	Action Methods
	//
	// ====================================================================


	public function indexAction() 
	{
		$this->_forward('browse');
	}

	public function deleteUserAction() 
	{
		$user 		= $this->_getUserFromRequest();

		if($user)
			$this->_userService->delete($user);

		$this->_forward('browse');
	}

	public function browseAction() 
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
		
	
		$page		= $this->_getParam('page', 1);
		$perPage	= $this->_getParam('perPage', 25);


		// ----------------------------------
		// 	Paginator
		// ----------------------------------
		
		$request	= new Skyseek_Model_Entity_Collection_Request($page, $perPage);
		$users	= GTW_Model_User_Mapper::getInstance()->getPaginator($request);


		$this->view->users = $users;
	}

	public function editAction() 
	{
		$request 	= $this->getRequest();
		$user 		= $this->_getUserFromRequest();
		$form 		= $this->_userService->getForm($user);

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_userService->save($form->getUser());
				$this->view->saveSuccess = true;
			} else
				$this->view->saveError = true;
		}


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form = $form;
		$this->view->user = $user;
	}


	protected function _getUserFromRequest() 
	{
		// ----------------------------------
		// 	User ID
		// ----------------------------------

		$userId = $this->_getParam('id');

		if(!$userId) {
			GTW_Messenger::getInstance()->addMessage('No User ID given.', 'notice');
			$this->_forward('browse');
		}
			

		// ----------------------------------
		// 	User
		// ----------------------------------

		$user = $this->_userService->getUserById($userId);

		if(!$user) {
			GTW_Messenger::getInstance()->addMessage("User with ID '$userId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $user;
	}
}
