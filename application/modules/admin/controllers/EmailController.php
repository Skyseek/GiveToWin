<?php

class Admin_EmailController extends Zend_Controller_Action
{
	protected $_emailService;

    public function init() {
        $this->_emailService = GTW_Service_Email::getInstance();
    }

    public function indexAction()
    {
        
    }

    public function browseTemplatesAction() {
        $this->view->templates = $this->_emailService->getAllTemplates();
    }

	public function previewTemplateAction() {
		$id = (int) $this->_getParam('id');
		$template = $this->_emailService->getTemplate($id);
		if(!$template)
			$this->_forward('browse-templates');


		$this->view->city = $this->createCity();
		$this->view->user = $this->createTestUser();
		$this->view->template = $template;
	}

    public function editTemplateAction() {


        $id = (int) $this->_getParam('id');
		$template = $this->_emailService->getTemplate($id);
		if(!$template) 
			$this->_forward('browse-templates');

		$request = $this->getRequest();
		$form = $this->_emailService->getTemplateForm($template);

		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_emailService->save($form->getTemplate());
				$this->view->saveSuccess = true;
			} else
				$this->view->saveError = true;
		}
		
		$this->view->form = $form;
		$this->view->template = $template;
    }












	private function createCity() {
		$city = new GTW_Model_City();
		$city->city = 'Atlanta';
		$city->id = 123;
		$city->setState(new GTW_Model_State(array(
			'state' => 'Georgia',
			'id' => 1
		)));

		return $city;
	}



	private function createTestUser() {
		return new GTW_Model_User(array(
			'id'			=> 1,
			'first_name'	=> "John",
			'last_name'		=> "Doe",
			'email'			=> 'john_doe@gmail.com',
			'status'		=> $this->createTestStatus(),
			'gender'		=> "Male",
			'birth_date'	=> "2000-12-25"
		));
	}

	private function createTestStatus() {
		return new GTW_Model_User_Status(
			array(
				'id'			=> 1,
				'status'		=> 'Active',
				'description'	=> 'User is active.'
			)
		);
	}
}





