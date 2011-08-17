<?php

class Admin_EmailController extends Zend_Controller_Action
{
	protected $_emailService;

    public function init() {
        $this->_emailService = GTW_Service_Email::getInstance();
    }

    public function indexAction()
    {
        // action body
    }

    public function browseTemplatesAction() {
        $this->view->templates = $this->_emailService->getAllTemplates();
    }

    public function editTemplateAction() {
        $id = (int) $this->_getParam('id');

		if(!$id)
			$this->_forward('browse-templates');

		$this->view->form = $this->_emailService->getTemplateForm();

		echo $this->view->form;
		exit;

		$this->view->template = $this->_emailService->getTemplate($id);
    }
}





