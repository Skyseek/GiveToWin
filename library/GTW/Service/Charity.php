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
 * Charity Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Charity
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Charity
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
	// 	Charity Mapper
	// ----------------------------------
	
	protected $_charityMapper;

	/**
	 * Sets the Charity Mapper
	 * 
	 * @param GTW_Model_Charity_Mapper $charityMapper
	 */
	public function setCharityMapper(GTW_Model_Charity_Mapper $charityMapper) 
	{
		$this->_charityMapper = $charityMapper;
	}
	
	/**
	 * Gets the Charity Mapper
	 * 
	 * @return GTW_Model_Charity_Mapper
	 */
	public function getCharityMapper() 
	{
		if(!$this->_charityMapper)
			$this->_charityMapper = GTW_Model_Charity_Mapper::getInstance();

		return $this->_charityMapper;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Returns the Charity Entity with given id.
	 *
	 * @param $id charity_id to search for
	 * 
	 * @return GTW_Model_Charity Charity (if exists)
	 */
	public function getCharityById($id) 
	{
		return $this->getCharityMapper()->getCharity($id);
	}


	/**
	 * Saves a Charity Values
	 *
	 * @param $charity GTW_Model_Charity Charity Entity to save
	 * 
	 * @return GTW_Model_Charity Returns the same entity passed in.
	 */
	public function save(GTW_Model_Charity $charity) 
	{
		return $this->getCharityMapper()->save($charity);
	}


	/**
	 * Returns the Charity Form with loaded Charity.
	 *
	 * @param $id charity_id to search for
	 * 
	 * @return GTW_Model_Charity Charity (if exists)
	 */
	public function getForm(GTW_Model_Charity $charity = null) 
	{
		$form = new GTW_Model_Charity_Form();

		if($charity)
			$form->setCharity($charity);

		return $form;
	}
}