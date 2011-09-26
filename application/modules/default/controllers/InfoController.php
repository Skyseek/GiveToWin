<?php

class Default_InfoController extends Zend_Controller_Action
{
    protected $_serviceMap;

	public function init()
	{
		$this->_serviceMap = new GTW_Service_Map();
	}

    public function indexAction() {}
    public function aboutAction() {}
    public function faqAction() {}
    public function howItWorksAction() {}
    public function privacyPolicyAction() {}
    public function termsOfUseAction() {}
    public function jobsAction() {}
    public function helpAction() {}
    public function merchandiseAction() {}

    public function contactAction() {

    	$request	= $this->getRequest();
    	$form 		= new GTW_Model_Contact_Message_Form();
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			//Suggest the city.
			$this->_serviceMap->getSystemService()->submitContactUsMessage($form->getMessage());

			//Reset form.
			$form	= new GTW_Model_Contact_Message_Form();

			//Post success message.
			$this->view->message = "Your message has been sent. GTW Staff will review, and reply (if necessary) as soon as possible.";
		}

		$this->view->form = $form;

    }
}

