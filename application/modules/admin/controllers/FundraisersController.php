<?php

class Admin_FundraisersController extends Zend_Controller_Action
{

	protected $_charityService;
	protected $_fundraiserService;

	protected $_charity;
	
	public function init()
	{
		$this->_charityService 		= GTW_Service_Charity::getInstance();
		$this->_fundraiserService 	= GTW_Service_Fundraiser::getInstance();

		$this->_charity				= $this->_getCharityFromRequest();
		$this->view->charity 		= $this->_charity;
	}

	public function indexAction()
	{
		$this->_forward('browse');
	}

	public function deleteAction()
	{
		$fundraiser	= $this->_getFundraiserFromRequest();

		if($fundraiser)
			$this->_fundraiserService->delete($fundraiser);

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
		$request->setOrderBy(array('status_id','title'));

		if($this->_charity) 
			$request->addFilter('charity_id', '=', $this->_charity->id);

		$fundraisers	= $this->_fundraiserService->getFundraiserMapper()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------

		$this->view->fundraisers 	= $fundraisers;
	}

	public function editAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$fundraiser	= $this->_getFundraiserFromRequest();
		$form 		= $this->_fundraiserService->getForm($fundraiser);
		


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_fundraiserService->save($form->getFundraiser());
				$this->view->saveSuccess = true;

				// ----------------------------------
				// 	Fundraiser Image
				// ----------------------------------
				
				if(isset($_FILES['image'])) {
					$imageData	= file_get_contents($_FILES['image']['tmp_name']);
					$image = new Skyseek_Image($imageData);
					$image->resizeTo(176, 123);
					$image->saveToFile($fundraiser->imagePath, Skyseek_Image::PNG);
				}
			} else
				$this->view->saveError = true;
		}

		
		// ----------------------------------
		// 	Schedules
		// ----------------------------------
		
		$startDate 		= Zend_Date::now()->sub(3, Zend_Date::DAY);
		$endDate 		= Zend_Date::now()->add(7, Zend_Date::DAY);
		$schedulePlan 	= $this->_fundraiserService->getScheduleByDateRange($startDate, $endDate, null, $fundraiser, false);

		$request	= new Skyseek_Model_Entity_Collection_Request(1, 100);
		$request->setOrderBy('status_id');
		$request->addFilter('fundraiser_id', '=', $fundraiser->id);

		$schedules 		= GTW_Model_Fundraiser_Schedule_Mapper::getInstance()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form 			= $form;
		$this->view->fundraiser 	= $fundraiser;
		$this->view->schedulePlan	= $schedulePlan;
		$this->view->schedules 		= $schedules;
	}

	public function createAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$form 		= $this->_fundraiserService->getForm();


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {

				$fundraiser = $this->_fundraiserService->save($form->getFundraiser());
				$this->_redirect($this->_helper->url->url(array(
					'action'	=> 'edit', 
					'id'		=> $fundraiser->id
				)));

			} else
				$this->view->saveError = true;
		} else {
			if($this->_charity)
				$form->setSelectedCharity($this->_charity);
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
	
	protected function _getFundraiserFromRequest() 
	{
		// ----------------------------------
		// 	Fundraiser ID
		// ----------------------------------

		$fundraiserId = $this->_getParam('id');

		if(!$fundraiserId) {
			GTW_Messenger::getInstance()->addMessage('No Fundraiser ID given.', 'notice');
			$this->_forward('browse');
		}
			

		// ----------------------------------
		// 	Fundraiser
		// ----------------------------------

		$fundraiser = $this->_fundraiserService->getFundraiserById($fundraiserId);

		if(!$fundraiser) {
			GTW_Messenger::getInstance()->addMessage("Fundraiser with ID '$fundraiserId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $fundraiser;
	}

	protected function _getCharityFromRequest() 
	{
		// ----------------------------------
		// 	Charity ID
		// ----------------------------------

		$charityId = $this->_getParam('charity_id');
		if(!$charityId)
			return null;
			

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







