<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function searchAction()
    {
    	$this->_helper->layout()->disableLayout();


    	// ----------------------------------
    	// 	Users
    	// ----------------------------------
    	
    	$userRequest 	= new Skyseek_Model_Entity_Collection_Request(1, 10);
    	$userRequest->addFilter(array('first_name', 'last_name', 'email'), 'contain', $_POST['s']);

    	$this->view->searchString = $_POST['s'];
    	$this->view->users = GTW_Service_User::getInstance()->getUserMapper()->getPaginator($userRequest);
    }
}

