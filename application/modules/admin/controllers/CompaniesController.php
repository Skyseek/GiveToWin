<?php

class Admin_CompaniesController extends Zend_Controller_Action
{
	protected $_companyService;
	
	public function init()
	{
		$this->_companyService = GTW_Service_Company::getInstance();
	}

	public function indexAction()
	{
		$this->_forward('browse');
	}

	public function deleteAction()
	{
		$company = $this->_getCompanyFromRequest();

		if($company)
			$this->_companyService->delete($company);

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

		$companies	= $this->_companyService->getCompanyMapper()->getPaginator($request);


		// ----------------------------------
		// 	View Parameters
		// ----------------------------------

		$this->view->companies = $companies;
	}

	public function editAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$company	= $this->_getCompanyFromRequest();
		$form 		= $this->_companyService->getForm($company);


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$this->_companyService->save($form->getCompany());
				$this->view->saveSuccess = true;

				// ----------------------------------
				// 	Company Logo
				// ----------------------------------
				
				if(isset($_FILES['logo'])) {
					$imageData	= file_get_contents($_FILES['logo']['tmp_name']);
					$image = new Skyseek_Image($imageData);
					$image->resizeTo(175, 65);
					$image->saveToFile($company->imagePath, Skyseek_Image::PNG);
				}

			} else
				$this->view->saveError = true;
		}

		// ----------------------------------
		// 	Offers
		// ----------------------------------
		
		$request	= new Skyseek_Model_Entity_Collection_Request(1, 10);
		$request->setOrderBy(array('status_id','id'));
		$request->addFilter('company_id', '=', $company->id);

		$offerService = GTW_Service_Offer::getInstance();
		$offers	= $offerService->getOfferMapper()->getPaginator($request);

		// ----------------------------------
		// 	View Parameters
		// ----------------------------------
		
		$this->view->form		= $form;
		$this->view->company	= $company;
		$this->view->offers		= $offers;
	}

	public function createAction()
	{
		// ----------------------------------
		// 	Input
		// ----------------------------------
				
		$request 	= $this->getRequest();
		$form 		= $this->_companyService->getForm();


		// ----------------------------------
		// 	Handle Form Actions
		// ----------------------------------
		
		if($request->isPost()) {
			if($form->isValid($request->getPost())) {
				$company = $this->_companyService->save($form->getCompany());
				$this->_redirect('/admin/companies/edit/id/' . $company->id);
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
	
	protected function _getCompanyFromRequest() 
	{
		// ----------------------------------
		// 	Company ID
		// ----------------------------------

		$companyId = $this->_getParam('id');

		if(!$companyId) {
			GTW_Messenger::getInstance()->addMessage('No Company ID given.', 'notice');
			$this->_forward('browse');
		}
			

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







