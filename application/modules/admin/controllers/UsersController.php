<?php

class Admin_UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		
    }

    public function browseAction() {
        $userCollection = new GTW_Model_User_Collection(array(
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser(),
			$this->createTestUser()
		));

		$this->view->users = $userCollection;
    }

    public function editAction() {
        $this->view->user = $this->createTestUser();
    }



	private function createTestUser() {
		$firstNames = array('John', 'Jack', 'Sally', 'Sue');
		$lastNames = array('Johnson', 'Doe');

		$user = new GTW_Model_User(array(
			'id'			=> rand(1, 100),
			'first_name'	=> $firstNames[array_rand($firstNames)],
			'last_name'		=> $lastNames[array_rand($lastNames)],
			'email'			=> 'test@gmail.com',
			'status'		=> $this->createTestStatus()
		));

		return $user;
	}

	private function createTestStatus() {
		$statuses = array(
			array(
				'id'			=> 1,
				'status'		=> 'Active',
				'description'	=> 'User is active.'
			),
			array(
				'id'			=> 2,
				'status'		=> 'Pending',
				'description'	=> 'User is pending.'
			)
		);

		return new GTW_Model_User_Status($statuses[array_rand($statuses)]);
	}
}





