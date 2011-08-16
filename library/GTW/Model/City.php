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
 * City
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City extends Skyseek_Model_Entity {
    public $id;
	public $city;

	protected $_state;
	protected $_status;

	protected $_stateMapper;
	protected $_statusMapper;

	public function setState(GTW_Model_State $state) {
		$this->_state = $state;
	}

	public function getState() {
		if($this->_state == null && $this->referenceId('state_id')) {
			$this->_state = $this->stateMapper()->getState($this->referenceId('state_id'));
		}

		return $this->_state;
	}

	public function setStatus(GTW_Model_City_State $status) {
		$this->_status = $status;
	}

	public function getStatus() {
		if($this->_status == null && $this->referenceId('status_id')) {
			$this->_status = $this->statusMapper()->getStatus($this->referenceId('status_id'));
		}

		return $this->_status;
	}

	/**
	 *
	 * @param GTW_Model_City_Status_Mapper $statusMapper
	 */
	public function statusMapper(GTW_Model_City_Status_Mapper $statusMapper=null) {
		if($statusMapper)
			$this->_statusMapper = $statusMapper;

		if($this->_statusMapper === null)
			$this->_statusMapper = new GTW_Model_City_Status_Mapper();

		return $this->_statusMapper;
	}

	/**
	 *
	 * @param GTW_Model_City_Status_Mapper $stateMapper
	 */
	public function stateMapper(GTW_Model_State_Mapper $stateMapper=null) {
		if($stateMapper)
			$this->_stateMapper = $stateMapper;

		if($this->_stateMapper === null)
			$this->_stateMapper = new GTW_Model_State_Mapper();

		return $this->_stateMapper;
	}
}
