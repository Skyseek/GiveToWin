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
		$city = $cityService->getCitySelection();
		
		if(!$city)
			$this->_forward('index', 'index');
		
		$dealService = GTW_Service_Deal::getInstance();

		$this->view->fundraiserSchedule = $dealService->getFundraiserScheduleByCity($city);
		$this->view->offerSchedule		= $dealService->getOfferScheduleByCity($city);
		$this->view->comments			= array();
		$this->view->city				= $city;
	}
}



