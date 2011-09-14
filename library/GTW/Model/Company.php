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
 * Company Model
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Company extends Skyseek_Model_Entity 
{
	// ====================================================================
	//
	// 	Public Properties
	//
	// ====================================================================
	
    public $id;
	public $name;
	public $website;
	public $phone;
	public $email;
	
	// ----------------------------------
	// 	Status
	// ----------------------------------
	
	
	protected $_status;
	
	/**
	 * @param GTW_Model_Company_Status $status
	 */
	public function setStatus(GTW_Model_Company_Status $status) 
	{
		$this->_status = $status;
	}
	
	/**
	 * @return GTW_Model_Company_Status
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
	
	public function getImageURL()
	{
		if(file_exists($this->getImagePath())) {
			return "/image/company/{$this->id}.png";
		} else {
			return '/image/company/default.png';
		}
	}


	public function getImagePath()
	{
		$imageDir = realpath(APPLICATION_PATH . '/../public_html/image/company');
		return "{$imageDir}/{$this->id}.png";
	}
	
	
	// ====================================================================
	//
	// 	Mappers
	//
	// ====================================================================
	
	
	
	// ----------------------------------
	// 	Status Mapper
	// ----------------------------------
	
	
	protected $_statusMapper;
	
	/**
	 * @param GTW_Model_Company_Status_Mapper $statusMapper
	 *
	 * @return GTW_Model_Company_Status_Mapper
	 */
	public function statusMapper(GTW_Model_Company_Status_Mapper $statusMapper=null) 
	{
		if ($statusMapper) 
		{
			$this->_statusMapper = $statusMapper;
		}
	
		if ($this->_statusMapper === null)
		{
			$this->_statusMapper = new GTW_Model_Company_Status_Mapper();
		}
	
		return $this->_statusMapper;
	}
		
}