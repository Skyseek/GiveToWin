<?php

class Default_CityController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
	}

	public function viewAction()
	{
		$cityService = GTW_Service_City::getInstance();
		$dealService = GTW_Service_Deal::getInstance();

		// ----------------------------------
		// 	City
		// ----------------------------------
		
		$city = $cityService->getCitySelection();
		
		if(!$city)
			$this->_forward('index', 'index');
		
		$this->view->city				= $city;

		
		// ----------------------------------
		// 	Fundraiser
		// ----------------------------------
		
		$this->view->fundraiserSchedule = $dealService->getFundraiserScheduleByCity($city);
		if(!$this->view->fundraiserSchedule)
			$this->_forward('no-fundraiser');

		
		// ----------------------------------
		// 	Offer
		// ----------------------------------
		
		$this->view->offerSchedule		= $dealService->getOfferScheduleByCity($city);
		if(!$this->view->offerSchedule)
			$this->_forward('no-offer');

		$this->view->comments			= array();
	}

	public function noFundraiserAction()
	{
		if($this->view->city === null)
			$this->_forward('view');
	}

	public function noOfferAction()
	{
		if($this->view->city === null)
			$this->_forward('view');
	}
}



