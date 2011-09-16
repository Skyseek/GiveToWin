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
 * User Model
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User extends Skyseek_Model_Entity 
{
	// ====================================================================
	//
	// 	Public Properties
	//
	// ====================================================================
	
	public $id;
	public $facebook_id;
	public $email;
	public $password;
	public $first_name;
	public $last_name;
	public $gender;
	public $birth_date;
	public $give_points;
	public $total_donated;


	// ====================================================================
	//
	// 	Private Variable
	//
	// ====================================================================
	
	protected $_mapper = 'GTW_Model_User_Mapper';

	
	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	
	/**
	 * Sets the Password using hash
	 * 
	 * @param $newPassword String New Password
	 */
	public function setNewPassword($newPassword) 
	{
		$this->password = md5($newPassword);
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
		if ($this->_city == null && $this->referenceId('city_id'))  {
			$this->_city = $this->cityMapper()->getCity($this->referenceId('city_id'));
		}

		return $this->_city;
	}

	
	// ----------------------------------
	// 	Role
	// ----------------------------------

	
	protected $_role;
	
	/**
	 * @param GTW_Model_User_Role $role
	 */
	public function setRole(GTW_Model_User_Role $role) 
	{
		$this->_role = $role;
	}

	/**
	 * @return GTW_Model_User_Role
	 */
	public function getRole() 
	{
		if ($this->_role == null && $this->referenceId('role_id')) 
		{
			$this->_role = $this->roleMapper()->getRole($this->referenceId('role_id'));
		}

		return $this->_role;
	}

	
	// ----------------------------------
	// 	Status
	// ----------------------------------

	
	protected $_status;
	
	/**
	 * @param GTW_Model_User_Status $status
	 */
	public function setStatus(GTW_Model_User_Status $status) 
	{
		$this->_status = $status;
	}

	/**
	 * @return GTW_Model_User_Status
	 */
	public function getStatus() 
	{
		if ($this->_status == null && $this->referenceId('status_id')) 
		{
			$this->_status = $this->statusMapper()->getStatus($this->referenceId('status_id'));
		}

		return $this->_status;
	}

	// ====================================================================
	//
	// 	Helper Properties
	//
	// ====================================================================


	public function getAlias()
	{
		return $this->first_name . ' ' . $this->last_name;
	}
	
	
	// ====================================================================
	//
	// 	Data Mappers
	//
	// ====================================================================


	// ----------------------------------
	// 	City Mapper
	// ----------------------------------
	
	
	protected $_cityMapper;
	
	/**
	 * @param GTW_Model_City_Mapper $cityMapper
	 * @return GTW_Model_City_Mapper
	 */
	public function cityMapper(GTW_Model_City_Mapper $cityMapper=null) 
	{
		if ($cityMapper)
		{
			$this->_cityMapper = $cityMapper;
		}

		if ($this->_cityMapper === null)
		{
			$this->_cityMapper = new GTW_Model_City_Mapper();
		}

		return $this->_cityMapper;
	}
	
	
	// ----------------------------------
	// 	Role Mapper
	// ----------------------------------
	
	
	protected $_roleMapper;	
	
	/**
	 * @param GTW_Model_User_Role_Mapper $roleMapper
	 * @return GTW_Model_User_Role_Mapper
	 */
	public function roleMapper(GTW_Model_User_Role_Mapper $roleMapper=null) 
	{
		if ($roleMapper)
		{
			$this->_roleMapper = $roleMapper;
		}

		if ($this->_roleMapper === null)
		{
			$this->_roleMapper = new GTW_Model_User_Role_Mapper();
		}

		return $this->_roleMapper;
	}


	// ----------------------------------
	// 	Status Mapper
	// ----------------------------------
	
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_User_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_User_Status_Mapper
	 */
	public function statusMapper(GTW_Model_User_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}

		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_User_Status_Mapper();
		}

		return $this->_statusMapper;
	}

	
}
