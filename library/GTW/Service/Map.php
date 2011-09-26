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
	// 	Charities
	//
	// ====================================================================
	
	// ----------------------------------
	// 	Charity Service
	// ----------------------------------
	
	protected $_charityService;

	/**
	 * Sets the Charity Service
	 * 
	 * @param GTW_Service_Charity $charityService
	 */
	public function setCharityService(GTW_Service_Charity $charityService) 
	{
		$this->_charityService = $charityService;
	}
	
	/**
	 * Gets the Charity Service
	 * 
	 * @return GTW_Service_Charity
	 */
	public function getCharityService() 
	{
		if(!$this->_charityService)
			$this->_charityService = GTW_Service_Charity::getInstance();

		return $this->_charityService;
	}


	// ----------------------------------
	// 	Charity Mapper
	// ----------------------------------
	
	protected $_charityMapper;

	/**
	 * Sets the Charity Mapper
	 * 
	 * @param GTW_Model_Charity_Mapper $charityMapper
	 */
	public function setCharityMapper(GTW_Model_Charity_Mapper $charityMapper) 
	{
		$this->_charityMapper = $charityMapper;
	}
	
	/**
	 * Gets the Charity Mapper
	 * 
	 * @return GTW_Model_Charity_Mapper
	 */
	public function getCharityMapper() 
	{
		if(!$this->_charityMapper)
			$this->_charityMapper = GTW_Model_Charity_Mapper::getInstance();

		return $this->_charityMapper;
	}

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
	// 	Companies
	//
	// ====================================================================
	
	// ----------------------------------
	// 	Company Service
	// ----------------------------------
	
	protected $_companyService;

	/**
	 * Sets the Company Service
	 * 
	 * @param GTW_Service_Company $companyService
	 */
	public function setCompanyService(GTW_Service_Company $companyService) 
	{
		$this->_companyService = $companyService;
	}
	
	/**
	 * Gets the Company Service
	 * 
	 * @return GTW_Service_Company
	 */
	public function getCompanyService() 
	{
		if(!$this->_companyService)
			$this->_companyService = GTW_Service_Company::getInstance();

		return $this->_companyService;
	}


	// ----------------------------------
	// 	Company Mapper
	// ----------------------------------
	
	protected $_companyMapper;

	/**
	 * Sets the Company Mapper
	 * 
	 * @param GTW_Model_Company_Mapper $companyMapper
	 */
	public function setCompanyMapper(GTW_Model_Company_Mapper $companyMapper) 
	{
		$this->_companyMapper = $companyMapper;
	}
	
	/**
	 * Gets the Company Mapper
	 * 
	 * @return GTW_Model_Company_Mapper
	 */
	public function getCompanyMapper() 
	{
		if(!$this->_companyMapper)
			$this->_companyMapper = GTW_Model_Company_Mapper::getInstance();

		return $this->_companyMapper;
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


	// ====================================================================
	//
	// 	System Service
	//
	// ====================================================================
	
	

	protected $_systemService;

	/**
	 * Sets the System Service
	 * 
	 * @param GTW_Service_System $systemService
	 */
	public function setSystemService(GTW_Service_System $systemService) 
	{
		$this->_systemService = $systemService;
	}
	
	/**
	 * Gets the System Service
	 * 
	 * @return GTW_Service_System
	 */
	public function getSystemService() 
	{
		if(!$this->_systemService)
			$this->_systemService = GTW_Service_System::getInstance();

		return $this->_systemService;
	}
}