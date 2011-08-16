<?php
/** 
 * Givetowin.org License, Version 1.0
 * 
 * You may not modify or use this file except with written permission 
 * from Givetowin.org.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Givetowin.org
 */






/**
 * Subscription
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City_Subscription extends Skyseek_Model_Entity {
    public $id;

	protected $_user;
	protected $_userMapper;

	protected $_city;
	protected $_cityMapper;

	/**
	 * @param GTW_Model_City $city
	 */
	public function setCity(GTW_Model_City $city) {
		$this->_city = $city;
	}

	/**
	 * @return GTW_Model_City
	 */
	public function getCity() {
		if ($this->_city == null && $this->referenceId('city_id')) {
			$this->_city = $this->cityMapper()->find($this->referenceId('city_id'));
		}

		return $this->_city;
	}


	/**
	 * @param GTW_Model_User $user
	 */
	public function setUser(GTW_Model_User $user) {
		$this->_user = $user;
	}

	/**
	 * @return GTW_Model_User
	 */
	public function getUser() {
		if ($this->_user == null && $this->referenceId('user_id')) {
			$this->_user = $this->userMapper()->find($this->referenceId('user_id'));
		}

		return $this->_user;
	}

	/**
	 * @param GTW_Model_User_Mapper $userMapper
	 * @return GTW_Model_User_Mapper
	 */
	public function userMapper(GTW_Model_User_Mapper $userMapper=null) {
		if ($userMapper)
			$this->_userMapper = $userMapper;

		if ($this->_userMapper === null)
			$this->_userMapper = new GTW_Model_User_Mapper();

		return $this->_userMapper;
	}


	/**
	 * @param GTW_Model_City_Mapper $cityMapper
	 * @return GTW_Model_City_Mapper
	 */
	public function cityMapper(GTW_Model_City_Mapper $cityMapper=null) {
		if ($cityMapper)
			$this->_cityMapper = $cityMapper;

		if ($this->_cityMapper === null)
			$this->_cityMapper = new GTW_Model_City_Mapper();

		return $this->_cityMapper;
	}
}
