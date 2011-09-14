<?php

class Default_IndexController extends Zend_Controller_Action
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	


	public function init() 
	{
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	
	public function indexAction() 
	{
		$cityService = GTW_Service_City::getInstance();
	
		if(isset($_REQUEST['city_id'])) {
			$city = $cityService->getCityById($_REQUEST['city_id']);
			
			if($city) {
				$cityService->setCitySelection($city);
				
				if(isset($_POST['email'])) {
					$userService = GTW_Service_User::getInstance();
					$user = $userService->getSubscriberByEmail($_POST['email'], TRUE);
					
					if($user) {
						$subscriptionService = GTW_Service_CitySubscription::getInstance();
						$subscriptionService->addSubscriberToCity($user, $city);
					}
				}
			}
		}
		
		//Direct Traffic
		if(!$cityService->hasCitySelected())
			$this->_forward ('new-visitor');
		else
			$this->_forward ('view', 'city');
	}

	public function newVisitorAction() 
	{
		$this->view->cities = GTW_Service_City::getInstance()->getCityCollection();
	}
}
