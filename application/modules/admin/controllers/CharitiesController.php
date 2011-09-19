<?php

class Admin_CharitiesController extends Zend_Controller_Action
{
	protected $_charityService;

	public function init()
	{
		$this->_charityService = GTW_Service_Charity::getInstance();
	}

	public function indexAction()
	{
		$this->_forward('browse');
	}

	public function deleteAction()
	{
		$charity	= $this->_getCharityFromRequest();

		if($charity)
			$this->_charityService->delete($charity);

		$this->_forward('browse');
	}

	public function browseAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
		
		$page		= $this->_getParam('page', 1);
		$perPage	= $this->_getParam('perPage', 10);


		// ----------------------------------
		// 	Paginator
		// ----------------------------------
		
		$request	= new Skyseek_Model_Entity_Collection_Request($page, $perPage);
		$request->setOrderBy(array('status_id','name'));

		$charities	= $this->_charityService->getCharityMapper()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------

		$this->view->charities = $charities;
	}

	public function editAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$charity	= $this->_getCharityFromRequest();
		$form 		= $this->_charityService->getForm($charity);

		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_charityService->save($form->getCharity());
				$this->view->saveSuccess = true;

				// ----------------------------------
				// 	Charity Logo
				// ----------------------------------
				
				if(isset($_FILES['logo'])) {
					$imageData	= file_get_contents($_FILES['logo']['tmp_name']);
					$image = new Skyseek_Image($imageData);
					$image->resizeTo(175, 65);
					$image->saveToFile($charity->imagePath, Skyseek_Image::PNG);
				}

			} else
				$this->view->saveError = true;
		}


		// ----------------------------------
		// 	Fundraisers
		// ----------------------------------
		
		$request	= new Skyseek_Model_Entity_Collection_Request(1, 10);
		$request->setOrderBy(array('status_id','id'));
		$request->addFilter('charity_id', '=', $charity->id);

		$fundraiserService = GTW_Service_Fundraiser::getInstance();
		$fundraisers	= $fundraiserService->getFundraiserMapper()->getPaginator($request);



		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form = $form;
		$this->view->charity = $charity;
		$this->view->fundraisers = $fundraisers;
	}

	public function createAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$form 		= $this->_charityService->getForm();


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$charity = $this->_charityService->save($form->getCharity());
				$this->_redirect('/admin/charities/edit/id/' . $charity->id);
				exit;
			} else
				$this->view->saveError = true;
		}


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form = $form;
	}



	// ====================================================================
	//
	// 	Private Helper Functions
	//
	// ====================================================================
	
	protected function _getCharityFromRequest() 
	{
		// ----------------------------------
		// 	Charity ID
		// ----------------------------------

		$charityId = $this->_getParam('id');

		if(!$charityId) {
			GTW_Messenger::getInstance()->addMessage('No Charity ID given.', 'notice');
			$this->_forward('browse');
		}
			

		// ----------------------------------
		// 	Charity
		// ----------------------------------

		$charity = $this->_charityService->getCharityById($charityId);

		if(!$charity) {
			GTW_Messenger::getInstance()->addMessage("Charity with ID '$charityId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $charity;
	}

}







