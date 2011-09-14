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
 * City Subscription Entity
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City_Subscription extends Skyseek_Model_Entity 
{

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	public $id;

	// ----------------------------------
	// 	User
	// ----------------------------------
	
	protected $_user;
	
	/**
	 * @param GTW_Model_User $user
	 */
	public function setUser(GTW_Model_User $user) 
	{
		$this->_user = $user;
	}

	/**
	 * @return GTW_Model_User
	 */
	public function getUser() 
	{
		if ($this->_user == null && $this->referenceId('user_id')) {
			$this->_user = $this->userMapper()->find($this->referenceId('user_id'));
		}

		return $this->_user;
	}
	
	// ----------------------------------
	// 	City
	// ----------------------------------
	
	protected $_city;
	
	/**
	 * @param GTW_Model_City $city
	 */
	public function setCity(GTW_Model_City $city) 
	{
		$this->_city = $city;
	}

	/**
	 * @return GTW_Model_City
	 */
	public function getCity() 
	{
		if ($this->_city == null && $this->referenceId('city_id')) {
			$this->_city = $this->cityMapper()->find($this->referenceId('city_id'));
		}

		return $this->_city;
	}	
	
	
	// ====================================================================
	//
	// 	Data Mappers
	//
	// ====================================================================
	
	// ----------------------------------
	// 	User Mapper
	// ----------------------------------
	
	protected $_userMapper;

	/**
	 * Get/Sets The User Mapper
	 *
	 * @param GTW_Model_User_Mapper $userMapper
	 *
	 * @return GTW_Model_User_Mapper
	 */
	public function userMapper(GTW_Model_User_Mapper $userMapper=null) 
	{
		//Set User Mapper (if given)
		if ($userMapper)
			$this->_userMapper = $userMapper;

		//Create default Mapper(if none)
		if ($this->_userMapper === null)
			$this->_userMapper = new GTW_Model_User_Mapper();

		return $this->_userMapper;
	}

	// ----------------------------------
	// 	City Mapper
	// ----------------------------------
	
	protected $_cityMapper;

	/**
	 * Get/Sets The City Mapper
	 *
	 * @param GTW_Model_City_Mapper $cityMapper
	 *
	 * @return GTW_Model_City_Mapper
	 */
	public function cityMapper(GTW_Model_City_Mapper $cityMapper=null) 
	{
		if ($cityMapper)
			$this->_cityMapper = $cityMapper;

		if ($this->_cityMapper === null)
			$this->_cityMapper = new GTW_Model_City_Mapper();

		return $this->_cityMapper;
	}
}
