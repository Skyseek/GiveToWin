<?php

class Default_UserController extends Zend_Controller_Action
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
		// action body
	}

	public function loginAction()
	{
		$this->_forward('login', 'auth');
	}

	public function logoutAction()
	{
		$this->_forward('logout', 'auth');
	}

	public function registerAction()
	{
		$request 	= $this->getRequest();
		$form 		= new GTW_Model_User_Form_Register();
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			$user = $form->getUser();

			if($this->_userService->register($user)) {
				$this->_userService->startSession($user);
				$this->_redirect('/user/register-complete');
			} else {
				$this->view->message = current(GTW_Messenger::getInstance()->getMessages())->body;
			}
		}

		$this->view->form = $form;
	}

	public function registerCompleteAction()
	{
		
	}

	public function accountAction()
	{

		$request 	= $this->getRequest();
		$user 		= $this->_userService->getCurrentUser();

		$editAccountForm 	= new GTW_Model_User_Form_EditAccount();
		$editAccountForm->setUser($user);

		$changePasswordForm = new GTW_Model_User_Form_ChangePassword();
		$changePasswordForm->setUser($user);

		//Default Selected Tab
		$this->view->mootabsSelectedIndex = 0;

		
		
		if($request->isPost() && isset($_POST['action'])) {
			if($_POST['action'] == 'editAccount') {
				// ----------------------------------
				//     Edit Account Form
				// ----------------------------------

				if($editAccountForm->isValid($request->getPost())) {
					$this->_userService->save($editAccountForm->getUser());
					$this->view->success = "Your Account was updated successfully.";
				} else
					$this->view->error = "We were unable to save changes to your account.";
			} else if($_POST['action'] == 'changePassword') {
				// ----------------------------------
				//     Change Password Form
				// ----------------------------------

				if($changePasswordForm->isValid($request->getPost())) {
					$this->_userService->save($changePasswordForm->getUser());
					$this->view->success = "Your password was set successfully.";
				} else
					$this->view->error = "We were unable to set your password.";
			}
		}


		$this->view->changePasswordForm = $changePasswordForm;
		$this->view->editAccountForm = $editAccountForm;
		$this->view->user = $user;
	}
}