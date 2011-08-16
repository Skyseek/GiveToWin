<?php

class Admin_UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		echo "<pre>";
		$statuses = new GTW_Model_User_Status_Mapper();
		$status = $statuses->find(GTW_Model_User_Status::ACTIVE);


        $users = GTW_Model_User_Mapper::getInstance();
		print_r($users);exit;

		$user = $users->delete(1);
		$user = $users->find(1);
		//$users->save($user);

		//$user->first_name = 'Sean';
		//$users->save($user);

		print_r($user);

		exit;
    }


}

