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
  * Fundraiser Status Entity
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Model_Fundraiser_Schedule extends Skyseek_Model_Entity
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	public $id;
	public $start_date;
	public $end_date;
	
	
	// ====================================================================
	//
	// 	Mapped Properties
	//
	// ====================================================================
	

	// ----------------------------------
	// 	Fundraiser
	// ----------------------------------
	
	
	protected $_fundraiser;
	
	/**
	 * @param GTW_Model_Fundraiser $fundraiser
	 */
	public function setFundraiser(GTW_Model_Fundraiser $fundraiser) 
	{
		$this->_fundraiser = $fundraiser;
	}
	
	/**
	 * @return GTW_Model_Fundraiser
	 */
	public function getFundraiser() 
	{
		if ($this->_fundraiser == null && $this->referenceId('fundraiser_id')) 
		{
			$this->_fundraiser = $this->fundraiserMapper()->getFundraiser($this->referenceId('fundraiser_id'));
		}
	
		return $this->_fundraiser;
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
		
		if ($this->_city == null && $this->referenceId('city_id')) 
		{
			$this->_city = $this->cityMapper()->getCity($this->referenceId('city_id'));
		}

		return $this->_city;
	}


	// ----------------------------------
	// 	Status
	// ----------------------------------

	protected $_status;
	
	/**
	 * @param GTW_Model_Fundraiser_Schedule_Status $status
	 */
	public function setStatus(GTW_Model_Fundraiser_Schedule_Status $status) 
	{
		$this->_status = $status;
	}

	
	/**
	 * @return GTW_Model_Fundraiser_Schedule_Status
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
	// 	Entity Mappers
	//
	// ====================================================================
		
	
	// ----------------------------------
	// 	Fundraiser Mapper
	// ----------------------------------
	
	
	protected $_fundraiserMapper;
	
	/**
	 * @param GTW_Model_Fundraiser_Mapper $fundraiserMapper
	 *
	 * @return GTW_Model_Fundraiser_Mapper
	 */
	public function fundraiserMapper(GTW_Model_Fundraiser_Mapper $fundraiserMapper=null) 
	{
		if ($fundraiserMapper) 
		{
			$this->_fundraiserMapper = $fundraiserMapper;
		}
	
		if ($this->_fundraiserMapper === null)
		{
			$this->_fundraiserMapper = new GTW_Model_Fundraiser_Mapper();
		}
	
		return $this->_fundraiserMapper;
	}


	// ----------------------------------
	// 	City Mapper
	// ----------------------------------
	
	
	protected $_cityMapper;
	
	/**
	 * @param GTW_Model_City_Mapper $cityMapper
	 *
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
	// 	Status Mapper
	// ----------------------------------
	
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_Fundraiser_Schedule_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_Fundraiser_Schedule_Status_Mapper
	 */
	public function statusMapper(GTW_Model_Fundraiser_Schedule_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}
	
		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_Fundraiser_Schedule_Status_Mapper();
		}
	
		return $this->_statusMapper;
	}
}
