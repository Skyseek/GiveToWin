<?php

require_once dirname(__FILE__) . '/../../../../../library/GTW/Model/User/Status.php';

/**
 * Test class for GTW_Model_User_Status.
 * Generated by PHPUnit on 2011-08-09 at 06:05:13.
 */
class GTW_Model_User_StatusTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var GTW_Model_User_Status
	 */
	protected $object;

	public function testArrayConstructor() {
		$statusData = array(
			'id'			=> 1,
			'status'		=> 'active',
			'description'	=> 'user is active'
		);

		$this->object = new GTW_Model_User_Status($statusData);

		$this->assertEquals($statusData, $this->object->toArray());
	}

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new GTW_Model_User_Status;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

}

?>
