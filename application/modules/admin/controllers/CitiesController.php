<?php

class Admin_CitiesController extends Zend_Controller_Action
{

	protected $_cityService;

	public function init()
	{
		$this->_cityService = GTW_Service_City::getInstance();
	}

	public function indexAction()
	{
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
		$request->setOrderBy('state_id', 'city');

		$cities		= $this->_cityService->getCityMapper()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------

		$this->view->cities = $cities;
	}

	public function editAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$city		= $this->_getCityFromRequest();
		$form 		= $this->_cityService->getForm($city);


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_cityService->save($form->getCity());
				$this->view->saveSuccess = true;
			} else
				$this->view->saveError = true;
		}


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form = $form;
		$this->view->city = $city;
	}

	public function createAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$form 		= $this->_cityService->getForm();


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$city = $this->_cityService->save($form->getCity());
				$this->_redirect('/admin/cities/edit/id/' . $city->id);
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
	
	protected function _getCityFromRequest() 
	{
		// ----------------------------------
		// 	City ID
		// ----------------------------------

		$cityId = $this->_getParam('id');

		if(!$cityId) {
			GTW_Messenger::getInstance()->addMessage('No City ID given.', 'notice');
			$this->_forward('browse');
		}
			

		// ----------------------------------
		// 	City
		// ----------------------------------

		$city = $this->_cityService->getCityById($cityId);

		if(!$city) {
			GTW_Messenger::getInstance()->addMessage("City with ID '$cityId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $city;
	}
}







