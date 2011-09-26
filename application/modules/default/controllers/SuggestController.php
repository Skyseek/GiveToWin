<?php

class Default_SuggestController extends Zend_Controller_Action
{
	protected $_serviceMap;

	public function init()
	{
		$this->_serviceMap = new GTW_Service_Map();
	}

	public function indexAction()
	{
		// action body
	}

	public function cityAction()
	{
		$request	= $this->getRequest();
		$form		= new GTW_Model_City_Suggestion_Form();
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			//Suggest the city.
			$this->_serviceMap->getCityService()->suggestCity($form->getSuggestion());

			//Reset form.
			$form	= new GTW_Model_City_Suggestion_Form();

			//Post success message.
			$this->view->message = "City suggestions successfully posted. GTW staff will review.";
		}

		$this->view->form = $form;
	}

	public function nonProfitAction()
	{
		$request	= $this->getRequest();
		$form		= new GTW_Model_Charity_Suggestion_Form();
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			//Suggest the charity.
			$this->_serviceMap->getCharityService()->suggestCharity($form->getSuggestion());

			//Reset form.
			$form	= new GTW_Model_Charity_Suggestion_Form();

			//Post success message.
			$this->view->message = "Suggestion successfully received. GTW staff will review.";
		}

		$this->view->form = $form;
	}

	public function merchantAction()
	{
		$request	= $this->getRequest();
		$form		= new GTW_Model_Company_Suggestion_Form();
		
		if($request->isPost() && $form->isValid($request->getPost())) {
			//Suggest the company.
			$this->_serviceMap->getCompanyService()->suggestCompany($form->getSuggestion());

			//Reset form.
			$form	= new GTW_Model_Company_Suggestion_Form();

			//Post success message.
			$this->view->message = "Suggestoin successfully received. GTW staff will review.";
		}

		$this->view->form = $form;
	}

	public function friendAction()
	{
		// action body
	}
}









