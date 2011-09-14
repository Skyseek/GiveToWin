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
 * City Entity
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City extends Skyseek_Model_Entity 
{
	// ====================================================================
	//
	// 	Public Properties
	//
	// ====================================================================
	
    public $id;
	public $city;

	// ====================================================================
	//
	// 	Private Variable
	//
	// ====================================================================
	
	protected $_mapper = 'GTW_Model_City_Mapper';


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	// ----------------------------------
	// 	State
	// ----------------------------------
	
	
	protected $_state;
	
	/**
	 * @param GTW_Model_State $state
	 */
	public function setState(GTW_Model_State $state) 
	{
		$this->_state = $state;
	}
	
	/**
	 * @return GTW_Model_State
	 */
	public function getState() 
	{
		if ($this->_state == null && $this->referenceId('state_id')) 
		{
			$this->_state = $this->stateMapper()->getState($this->referenceId('state_id'));
		}
	
		return $this->_state;
	}


	// ----------------------------------
	// 	Status
	// ----------------------------------
	
	
	protected $_status;
	
	/**
	 * @param GTW_Model_City_Status $status
	 */
	public function setStatus(GTW_Model_City_Status $status) 
	{
		$this->_status = $status;
	}
	
	/**
	 * @return GTW_Model_City_Status
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
	// 	Mappers
	//
	// ====================================================================	

	
	// ----------------------------------
	// 	State Mapper
	// ----------------------------------	
	
	protected $_stateMapper;
	
	/**
	 * @param GTW_Model_State_Mapper $stateMapper
	 *
	 * @return GTW_Model_State_Mapper
	 */
	public function stateMapper(GTW_Model_State_Mapper $stateMapper=null) 
	{
		if ($stateMapper) 
		{
			$this->_stateMapper = $stateMapper;
		}
	
		if ($this->_stateMapper === null)
		{
			$this->_stateMapper = new GTW_Model_State_Mapper();
		}
	
		return $this->_stateMapper;
	}


	// ----------------------------------
	// 	Status Mapper
	// ----------------------------------
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_City_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_City_Status_Mapper
	 */
	public function statusMapper(GTW_Model_City_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}
	
		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_City_Status_Mapper();
		}
	
		return $this->_statusMapper;
	}
}
