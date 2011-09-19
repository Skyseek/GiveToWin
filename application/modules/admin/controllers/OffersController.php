<?php

class Admin_OffersController extends Zend_Controller_Action
{

	protected $_companyService;
	protected $_offerService;

	protected $_company;
	
	public function init()
	{
		$this->_companyService 		= GTW_Service_Company::getInstance();
		$this->_offerService 	= GTW_Service_Offer::getInstance();

		$this->_company				= $this->_getCompanyFromRequest();
		$this->view->company 		= $this->_company;
	}

	public function indexAction()
	{
		$this->_forward('browse');
	}

	public function deleteAction()
	{
		$offer = $this->_getOfferFromRequest();

		if($offer)
			$this->_offerService->delete($offer);

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

		if($this->_company) 
			$request->addFilter('company_id', '=', $this->_company->id);

		$offers	= $this->_offerService->getOfferMapper()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------

		$this->view->offers 	= $offers;
	}

	public function editAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$offer		= $this->_getOfferFromRequest();
		$form 		= $this->_offerService->getForm($offer);
		


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_offerService->save($form->getOffer());
				$this->view->saveSuccess = true;

				// ----------------------------------
				// 	Offer Image
				// ----------------------------------
				
				if(isset($_FILES['logo'])) {
					$imageData	= file_get_contents($_FILES['logo']['tmp_name']);
					$image = new Skyseek_Image($imageData);
					$image->resizeTo(176, 123);
					$image->saveToFile($offer->imagePath, Skyseek_Image::PNG);
				}
			} else
				$this->view->saveError = true;
		}

		
		// ----------------------------------
		// 	Schedules
		// ----------------------------------
		
		$startDate 		= Zend_Date::now()->sub(3, Zend_Date::DAY);
		$endDate 		= Zend_Date::now()->add(7, Zend_Date::DAY);
		$schedulePlan 	= $this->_offerService->getScheduleByDateRange($startDate, $endDate, null, $offer, false);

		$request	= new Skyseek_Model_Entity_Collection_Request(1, 100);
		$request->setOrderBy('status_id');
		$request->addFilter('offer_id', '=', $offer->id);

		$schedules 		= GTW_Model_Offer_Schedule_Mapper::getInstance()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form 			= $form;
		$this->view->offer 			= $offer;
		$this->view->schedulePlan	= $schedulePlan;
		$this->view->schedules 		= $schedules;
	}

	public function createAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$form 		= $this->_offerService->getForm();


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {

				$offer = $this->_offerService->save($form->getOffer());
				$this->_redirect($this->_helper->url->url(array(
					'action'	=> 'edit', 
					'id'		=> $offer->id
				)));

			} else
				$this->view->saveError = true;
		} else {
			if($this->_company)
				$form->setSelectedCompany($this->_company);
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
	
	protected function _getOfferFromRequest() 
	{
		// ----------------------------------
		// 	Offer ID
		// ----------------------------------

		$offerId = $this->_getParam('id');

		if(!$offerId) {
			GTW_Messenger::getInstance()->addMessage('No Offer ID given.', 'notice');
			$this->_forward('browse');
		}
			

		// ----------------------------------
		// 	Offer
		// ----------------------------------

		$offer = $this->_offerService->getOfferById($offerId);

		if(!$offer) {
			GTW_Messenger::getInstance()->addMessage("Offer with ID '$offerId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $offer;
	}

	protected function _getCompanyFromRequest() 
	{
		// ----------------------------------
		// 	Company ID
		// ----------------------------------

		$companyId = $this->_getParam('company_id');
		if(!$companyId)
			return null;
			

		// ----------------------------------
		// 	Company
		// ----------------------------------

		$company = $this->_companyService->getCompanyById($companyId);

		if(!$company) {
			GTW_Messenger::getInstance()->addMessage("Company with ID '$companyId' not found.", 'notice');
			$this->_forward('browse');
		}

		return $company;
	}

}







