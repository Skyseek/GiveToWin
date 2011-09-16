<?php
/**
 * Givetowin.org License, Version 1.0
 *
 * You may not modify or use this file except with written permission
 * from Give to Win, Inc.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND Give to Win HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 */


/**
 * GTW Service Map
 *
 * Addes helper functions for connectivity bloat.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Map
{
	// ====================================================================
	//
	// 	Cities
	//
	// ====================================================================
	
	// ----------------------------------
	// 	City Service
	// ----------------------------------
	
	protected $_cityService;

	/**
	 * Sets the City Service
	 * 
	 * @param GTW_Service_City $cityService
	 */
	public function setCityService(GTW_Service_City $cityService) 
	{
		$this->_cityService = $cityService;
	}
	
	/**
	 * Gets the City Service
	 * 
	 * @return GTW_Service_City
	 */
	public function getCityService() 
	{
		if(!$this->_cityService)
			$this->_cityService = GTW_Service_City::getInstance();

		return $this->_cityService;
	}


	// ----------------------------------
	// 	City Mapper
	// ----------------------------------
	
	protected $_cityMapper;

	/**
	 * Sets the City Mapper
	 * 
	 * @param GTW_Model_City_Mapper $cityMapper
	 */
	public function setCityMapper(GTW_Model_City_Mapper $cityMapper) 
	{
		$this->_cityMapper = $cityMapper;
	}
	
	/**
	 * Gets the City Mapper
	 * 
	 * @return GTW_Model_City_Mapper
	 */
	public function getCityMapper() 
	{
		if(!$this->_cityMapper)
			$this->_cityMapper = GTW_Model_City_Mapper::getInstance();

		return $this->_cityMapper;
	}


	// ====================================================================
	//
	// 	Emails
	//
	// ====================================================================
	
	// ----------------------------------
	// 	Email Service
	// ----------------------------------
	
	protected $_emailService;

	/**
	 * Sets the Email Service
	 * 
	 * @param GTW_Service_Email $emailService
	 */
	public function setEmailService(GTW_Service_Email $emailService) 
	{
		$this->_emailService = $emailService;
	}
	
	/**
	 * Gets the Email Service
	 * 
	 * @return GTW_Service_Email
	 */
	public function getEmailService() 
	{
		if(!$this->_emailService)
			$this->_emailService = GTW_Service_Email::getInstance();

		return $this->_emailService;
	}


	// ----------------------------------
	// 	Email Mapper
	// ----------------------------------
	
	protected $_emailMapper;

	/**
	 * Sets the Email Mapper
	 * 
	 * @param GTW_Model_Email_Mapper $emailMapper
	 */
	public function setEmailMapper(GTW_Model_Email_Mapper $emailMapper) 
	{
		$this->_emailMapper = $emailMapper;
	}
	
	/**
	 * Gets the Email Mapper
	 * 
	 * @return GTW_Model_Email_Mapper
	 */
	public function getEmailMapper() 
	{
		if(!$this->_emailMapper)
			$this->_emailMapper = GTW_Model_Email_Mapper::getInstance();

		return $this->_emailMapper;
	}




	// ====================================================================
	//
	// 	Users
	//
	// ====================================================================
	
	// ----------------------------------
	// 	User Service
	// ----------------------------------
	
	protected $_userService;

	/**
	 * Sets the User Service
	 * 
	 * @param GTW_Service_User $userService
	 */
	public function setUserService(GTW_Service_User $userService) 
	{
		$this->_userService = $userService;
	}
	
	/**
	 * Gets the User Service
	 * 
	 * @return GTW_Service_User
	 */
	public function getUserService() 
	{
		if(!$this->_userService)
			$this->_userService = GTW_Service_User::getInstance();

		return $this->_userService;
	}


	// ----------------------------------
	// 	User Mapper
	// ----------------------------------
	
	protected $_userMapper;

	/**
	 * Sets the User Mapper
	 * 
	 * @param GTW_Model_User_Mapper $userMapper
	 */
	public function setUserMapper(GTW_Model_User_Mapper $userMapper) 
	{
		$this->_userMapper = $userMapper;
	}
	
	/**
	 * Gets the User Mapper
	 * 
	 * @return GTW_Model_User_Mapper
	 */
	public function getUserMapper() 
	{
		if(!$this->_userMapper)
			$this->_userMapper = GTW_Model_User_Mapper::getInstance();

		return $this->_userMapper;
	}
}