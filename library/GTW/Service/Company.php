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
 * Company Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Company
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Company
	 */
	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new self();
		
		return self::$_instance;
	}
	
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	

	// ----------------------------------
	// 	Company Mapper
	// ----------------------------------
	
	protected $_companyMapper;

	/**
	 * Sets the Company Mapper
	 * 
	 * @param GTW_Model_Company_Mapper $companyMapper
	 */
	public function setCompanyMapper(GTW_Model_Company_Mapper $companyMapper) 
	{
		$this->_companyMapper = $companyMapper;
	}
	
	/**
	 * Gets the Company Mapper
	 * 
	 * @return GTW_Model_Company_Mapper
	 */
	public function getCompanyMapper() 
	{
		if(!$this->_companyMapper)
			$this->_companyMapper = GTW_Model_Company_Mapper::getInstance();

		return $this->_companyMapper;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Returns the Company Entity with given id.
	 *
	 * @param $id company_id to search for
	 * 
	 * @return GTW_Model_Company Company (if exists)
	 */
	public function getCompanyById($id) 
	{
		return $this->getCompanyMapper()->getCompany($id);
	}


	/**
	 * Saves a Company Values
	 *
	 * @param $company GTW_Model_Company Company Entity to save
	 * 
	 * @return GTW_Model_Company Returns the same entity passed in.
	 */
	public function save(GTW_Model_Company $company) 
	{
		return $this->getCompanyMapper()->save($company);
	}


	/**
	 * Returns the Company Form with loaded Company.
	 *
	 * @param $id company_id to search for
	 * 
	 * @return GTW_Model_Company Company (if exists)
	 */
	public function getForm(GTW_Model_Company $company = null) 
	{
		$form = new GTW_Model_Company_Form();

		if($company)
			$form->setCompany($company);

		return $form;
	}



}