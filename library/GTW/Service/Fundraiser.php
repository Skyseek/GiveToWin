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
 * Fundraiser Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Fundraiser
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Fundraiser
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
	// 	Fundraiser Mapper
	// ----------------------------------
	
	protected $_fundraiserMapper;

	/**
	 * Sets the Fundraiser Mapper
	 * 
	 * @param GTW_Model_Fundraiser_Mapper $fundraiserMapper
	 */
	public function setFundraiserMapper(GTW_Model_Fundraiser_Mapper $fundraiserMapper) 
	{
		$this->_fundraiserMapper = $fundraiserMapper;
	}
	
	/**
	 * Gets the Fundraiser Mapper
	 * 
	 * @return GTW_Model_Fundraiser_Mapper
	 */
	public function getFundraiserMapper() 
	{
		if(!$this->_fundraiserMapper)
			$this->_fundraiserMapper = GTW_Model_Fundraiser_Mapper::getInstance();

		return $this->_fundraiserMapper;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Returns the Fundraiser Entity with given id.
	 *
	 * @param $id fundraiser_id to search for
	 * 
	 * @return GTW_Model_Fundraiser Fundraiser (if exists)
	 */
	public function getFundraiserById($id) 
	{
		return $this->getFundraiserMapper()->getFundraiser($id);
	}


	/**
	 * Saves a Fundraiser Values
	 *
	 * @param $fundraiser GTW_Model_Fundraiser Fundraiser Entity to save
	 * 
	 * @return GTW_Model_Fundraiser Returns the same entity passed in.
	 */
	public function save(GTW_Model_Fundraiser $fundraiser) 
	{
		return $this->getFundraiserMapper()->save($fundraiser);
	}


	/**
	 * Returns the Fundraiser Form with loaded Fundraiser.
	 *
	 * @param $id fundraiser_id to search for
	 * 
	 * @return GTW_Model_Fundraiser Fundraiser (if exists)
	 */
	public function getForm(GTW_Model_Fundraiser $fundraiser = null) 
	{
		$form = new GTW_Model_Fundraiser_Form();

		if($fundraiser)
			$form->setFundraiser($fundraiser);

		return $form;
	}

	/**
	 * Get Schedule in Day Range
	 *
	 * @param $date Zend_Date
	 * @param $city GTW_Model_City
	 * @param $fundraiser GTW_Model_Fundraiser
	 * @param $returnActiveOnly Boolean
	 *
	 * @return GTW_Model_Offer_Schedule_Collection
	 */
	public function getScheduleByDate(Zend_Date $date, GTW_Model_City $city = null, GTW_Model_Fundraiser $fundraiser = null, $returnActiveOnly = true) 
	{
		return $this->getScheduleByDateRange($date, $date, $city, $fundraiser, $returnActiveOnly);
	}

	/**
	 * Get Schedule in Day Range
	 *
	 * @param $startDate Zend_Date
	 * @param $endDate Zend_Date
	 * @param $city GTW_Model_City
	 * @param $fundraiser GTW_Model_Fundraiser
	 * @param $returnActiveOnly Boolean
	 *
	 * @return GTW_Model_Offer_Schedule_Collection
	 */
	public function getScheduleByDateRange(Zend_Date $startDate, Zend_Date $endDate, GTW_Model_City $city = null, GTW_Model_Fundraiser $fundraiser = null, $returnActiveOnly = true)
	{
		$request = new Skyseek_Model_Entity_Collection_Request(1, 50);

		//Date Range
		$startTimeStamp = $startDate->toString(Zend_Date::ISO_8601);
		$endTimeStamp = $endDate->toString(Zend_Date::ISO_8601);

		$request->addFilter('start_date', 	"<= '$startTimeStamp' OR start_date >=", $startTimeStamp);
		$request->addFilter('end_date', 	"<= '$endTimeStamp' OR end_date >=", $endTimeStamp);

		//City
		if($city)
			$request->addFilter('city_id', '=', $city->id);

		//Fundraiser
		if($fundraiser)
			$request->addFilter('fundraiser_id', '=', $fundraiser->id);

		//Active Schedules Only
		if($returnActiveOnly)
			$request->addFilter('status_id', '=', 2);


		return GTW_Model_Fundraiser_Schedule_Mapper::getInstance()->getCollection($request);
	}

}