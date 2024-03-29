<?php

class Default_AuthController extends Zend_Controller_Action
{
	protected $_userService;

	public function init()
	{
		$this->_userService = GTW_Service_User::getInstance();
	}

	public function indexAction()
	{
		// action body
	}

	public function deniedAction()
	{
		// action body
	}

	public function loginAction()
	{
		$request 	= $this->getRequest();
		$form 		= new GTW_Model_User_Form_Login();
		
		if (strtolower($request->getParam('action','')) == 'validate') {
			$userId = $request->getParam('id');
			$user	= $this->_userService->getUserById($userId);

			if(isset($user->city->id)) {
				$this->_userService->getCityService()->setCitySelection($user->city);			
			}	
			
			$form->getElement('email')->setValue($user->email);
			
			$this->view->success = "You have successfully validated your email address!";
		}
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			$user = $form->getUser();

			if($this->_userService->login($user->email, $user->password)) {
				$this->_redirect('/');
			} else {
				$this->view->error = current(GTW_Messenger::getInstance()->getMessages())->body;
				$form->getElement('password')->setValue(null);
			}
		}

		$this->view->form = $form;
	}

	public function logoutAction()
	{
		$this->_userService->stopSession();
		$this->view->message = 'You are now logged out.';
		$this->_forward('login');
	}


}





