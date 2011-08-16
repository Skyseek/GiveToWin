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

    public function editTemplateAction()
    {
        // action body
    }
}





