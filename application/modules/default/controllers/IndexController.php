<?php

class Default_IndexController extends Zend_Controller_Action
{
	protected $_cityService;
	protected $_subscriptionService;

    public function init() {
        $this->_cityService			= GTW_Service_City::getInstance();
		$this->_subscriptionService	= GTW_Service_CitySubscription::getInstance();
    }

    public function indexAction() {
		if(isset($_POST['city_id']) && isset($_POST['email']))
			$this->_subscriptionService->addSubscriberToCity($_POST['email'], $_POST['city_id']);

        if(!$this->_cityService->hasCitySelected())
			$this->_forward ('new-visitor');
		else
			$this->_forward ('view', 'city');

    }

    public function newVisitorAction() {
        $this->view->cities = $this->_cityService->getAllCities();
    }
}