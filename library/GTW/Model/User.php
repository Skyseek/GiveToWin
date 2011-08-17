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
class GTW_Model_User extends Skyseek_Model_Entity {
    public $id;
	public $email;
	public $password;
	public $first_name;
	public $last_name;
	public $gender;
	public $birth_date;

	private $_status;
	private $_statusMapper;

	protected $_role;
	protected $_roleMapper;



	protected $_mapper = 'GTW_Model_User_Mapper';

	public function setNewPassword($newPassword) {
		$this->password = md5($newPassword);
	}

	/**
	 * @param GTW_Model_User_Role $role
	 */
	public function setRole(GTW_Model_User_Role $role) {
		$this->_role = $role;
	}

	/**
	 * @return GTW_Model_User_Role
	 */
	public function getRole() {
		if ($this->_role == null && $this->referenceId('role_id')) {
			$this->_role = $this->roleMapper()->find($this->referenceId('role_id'));
		}

		return $this->_role;
	}

	/**
	 *
	 * @param GTW_Model_User_Status $status
	 */
	public function setStatus(GTW_Model_User_Status $status) {
		$this->_status = $status;
	}

	/**
	 *
	 * @return GTW_Model_User_Status
	 */
	public function getStatus() {
		if($this->_status == null && $this->referenceId('status_id')) {
			$this->_status = $this->statusMapper()->find($this->referenceId('status_id'));
		}

		return $this->_status;
	}

	/**
	 * @param GTW_Model_User_Role_Mapper $roleMapper
	 * @return GTW_Model_User_Role_Mapper
	 */
	public function roleMapper(GTW_Model_User_Role_Mapper $roleMapper=null) {
		if ($roleMapper)
			$this->_roleMapper = $roleMapper;

		if ($this->_roleMapper === null)
			$this->_roleMapper = new GTW_Model_User_Role_Mapper();

		return $this->_roleMapper;
	}

	/**
	 *
	 * @param GTW_Model_User_Status_Mapper $statusMapper
	 */
	public function statusMapper(GTW_Model_User_Status_Mapper $statusMapper=null) {
		if($statusMapper)
			$this->_statusMapper = $statusMapper;

		if($this->_statusMapper === null)
			$this->_statusMapper = new GTW_Model_User_Status_Mapper();

		return $this->_statusMapper;
	}
}
