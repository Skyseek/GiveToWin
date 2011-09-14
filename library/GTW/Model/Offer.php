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
 * Offer Model
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Offer extends Skyseek_Model_Entity {

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================

	public $id;
	public $title;
	public $sub_title;
	public $description;
	public $fine_print;
	public $highlights;
	public $value;
	public $time_redeem;
	public $time_expire;
	public $minimum;
	
	
	// ====================================================================
	//
	// 	Mapped Properties
	//
	// ====================================================================
	

	// ----------------------------------
	// 	Company
	// ----------------------------------
	
	
	protected $_company;
	
	/**
	 * @param GTW_Model_Company $company
	 */
	public function setCompany(GTW_Model_Company $company) 
	{
		$this->_company = $company;
	}
	
	/**
	 * @return GTW_Model_Company
	 */
	public function getCompany() 
	{
		if ($this->_company == null && $this->referenceId('company_id')) 
		{
			$this->_company = $this->companyMapper()->getCompany($this->referenceId('company_id'));
		}
	
		return $this->_company;
	}

	// ----------------------------------
	// 	Status
	// ----------------------------------

	protected $_status;
	
	/**
	 * @param GTW_Model_Offer_Status $status
	 */
	public function setStatus(GTW_Model_Offer_Status $status) 
	{
		$this->_status = $status;
	}

	
	/**
	 * @return GTW_Model_Offer_Status
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
			return "/image/offer/{$this->id}.png";
		} else {
			return '/image/offer/default.png';
		}
	}


	public function getImagePath()
	{
		$imageDir = realpath(APPLICATION_PATH . '/../public_html/image/offer');
		return "{$imageDir}/{$this->id}.png";
	}

	public function getTotalDonationsCount()
	{
		return 0;
	}


	// ====================================================================
	//
	// 	Entity Mappers
	//
	// ====================================================================
		
	
	// ----------------------------------
	// 	Company Mapper
	// ----------------------------------
	
	
	protected $_companyMapper;
	
	/**
	 * @param GTW_Model_Company_Mapper $companyMapper
	 *
	 * @return GTW_Model_Company_Mapper
	 */
	public function companyMapper(GTW_Model_Company_Mapper $companyMapper=null) 
	{
		if ($companyMapper) 
		{
			$this->_companyMapper = $companyMapper;
		}
	
		if ($this->_companyMapper === null)
		{
			$this->_companyMapper = new GTW_Model_Company_Mapper();
		}
	
		return $this->_companyMapper;
	}


	// ----------------------------------
	// 	Status Mapper
	// ----------------------------------
	
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_Offer_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_Offer_Status_Mapper
	 */
	public function statusMapper(GTW_Model_Offer_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}
	
		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_Offer_Status_Mapper();
		}
	
		return $this->_statusMapper;
	}

}
