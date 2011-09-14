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
  * Fundraiser Entity
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Model_Fundraiser extends Skyseek_Model_Entity
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	public $id;
	public $title;
	public $goal;
	public $cost;
	public $description;
	
	
	// ====================================================================
	//
	// 	Mapped Properties
	//
	// ====================================================================
	

	// ----------------------------------
	// 	Charity
	// ----------------------------------
	
	
	protected $_charity;
	
	/**
	 * @param GTW_Model_Charity $charity
	 */
	public function setCharity(GTW_Model_Charity $charity) 
	{
		$this->_charity = $charity;
	}
	
	/**
	 * @return GTW_Model_Charity
	 */
	public function getCharity() 
	{
		if ($this->_charity == null && $this->referenceId('charity_id')) 
		{
			$this->_charity = $this->charityMapper()->getCharity($this->referenceId('charity_id'));
		}
	
		return $this->_charity;
	}

	// ----------------------------------
	// 	Status
	// ----------------------------------

	protected $_status;
	
	/**
	 * @param GTW_Model_Fundraiser_Status $status
	 */
	public function setStatus(GTW_Model_Fundraiser_Status $status) 
	{
		$this->_status = $status;
	}

	
	/**
	 * @return GTW_Model_Fundraiser_Status
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
	// 	Helpers
	//
	// ====================================================================
	
	public function getImageURL()
	{
		if(file_exists($this->getImagePath())) {
			return "/image/fundraiser/{$this->id}.png";
		} else {
			return '/image/fundraiser/default.png';
		}
	}


	public function getImagePath()
	{
		$imageDir = realpath(APPLICATION_PATH . '/../public_html/image/fundraiser');
		return "{$imageDir}/{$this->id}.png";
	}


	// ====================================================================
	//
	// 	Entity Mappers
	//
	// ====================================================================
		
	
	// ----------------------------------
	// 	Charity Mapper
	// ----------------------------------
	
	
	protected $_charityMapper;
	
	/**
	 * @param GTW_Model_Charity_Mapper $charityMapper
	 *
	 * @return GTW_Model_Charity_Mapper
	 */
	public function charityMapper(GTW_Model_Charity_Mapper $charityMapper=null) 
	{
		if ($charityMapper) 
		{
			$this->_charityMapper = $charityMapper;
		}
	
		if ($this->_charityMapper === null)
		{
			$this->_charityMapper = new GTW_Model_Charity_Mapper();
		}
	
		return $this->_charityMapper;
	}


	// ----------------------------------
	// 	Status Mapper
	// ----------------------------------
	
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_Fundraiser_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_Fundraiser_Status_Mapper
	 */
	public function statusMapper(GTW_Model_Fundraiser_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}
	
		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_Fundraiser_Status_Mapper();
		}
	
		return $this->_statusMapper;
	}
}
