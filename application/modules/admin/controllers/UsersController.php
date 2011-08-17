<?php

class Admin_UsersController extends Zend_Controller_Action
{

	protected $_userService;

    public function init() {
		$this->_userService = new GTW_Service_User();
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
		$this->view->form = $this->_userService->getEditForm();
        $this->view->user = $this->createTestUser();
		$this->view->form->populate($this->view->user->toArray());

		$this->view->form->getElement('gender')->setMultiOptions(array("Female", "Male"));
		$this->view->form->getElement('status')->setMultiOptions(array("Active", "Suspended"));
		$this->view->form->getElement('role')->setMultiOptions(array("Subscriber", "Member", "Admin"));
    }



	private function createTestUser() {
		$firstNames = array('John', 'Jack', 'Sally', 'Sue');
		$lastNames = array('Johnson', 'Doe');
		$genders = array('Male', 'Female');

		$user = new GTW_Model_User(array(
			'id'			=> rand(1, 100),
			'first_name'	=> $firstNames[array_rand($firstNames)],
			'last_name'		=> $lastNames[array_rand($lastNames)],
			'email'			=> 'test@gmail.com',
			'status'		=> $this->createTestStatus(),
			'gender'		=> $genders[array_rand($genders)],
			'birth_date'	=> "2000-12-25"
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





