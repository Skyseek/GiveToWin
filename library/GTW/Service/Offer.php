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
 * Offer Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Offer
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Offer
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
	// 	Offer Mapper
	// ----------------------------------
	
	protected $_offerMapper;

	/**
	 * Sets the Offer Mapper
	 * 
	 * @param GTW_Model_Offer_Mapper $offerMapper
	 */
	public function setOfferMapper(GTW_Model_Offer_Mapper $offerMapper) 
	{
		$this->_offerMapper = $offerMapper;
	}
	
	/**
	 * Gets the Offer Mapper
	 * 
	 * @return GTW_Model_Offer_Mapper
	 */
	public function getOfferMapper() 
	{
		if(!$this->_offerMapper)
			$this->_offerMapper = GTW_Model_Offer_Mapper::getInstance();

		return $this->_offerMapper;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Returns the Offer Entity with given id.
	 *
	 * @param $id offer_id to search for
	 * 
	 * @return GTW_Model_Offer Offer (if exists)
	 */
	public function getOfferById($id) 
	{
		return $this->getOfferMapper()->getOffer($id);
	}


	/**
	 * Saves a Offer Values
	 *
	 * @param $offer GTW_Model_Offer Offer Entity to save
	 * 
	 * @return GTW_Model_Offer Returns the same entity passed in.
	 */
	public function save(GTW_Model_Offer $offer) 
	{
		return $this->getOfferMapper()->save($offer);
	}


	/**
	 * Returns the Offer Form with loaded Offer.
	 *
	 * @param $id offer_id to search for
	 * 
	 * @return GTW_Model_Offer Offer (if exists)
	 */
	public function getForm(GTW_Model_Offer $offer = null) 
	{
		$form = new GTW_Model_Offer_Form();

		if($offer)
			$form->setOffer($offer);

		return $form;
	}

	/**
	 * Get Schedule for a specific date.
	 *
	 * @param $date Zend_Date
	 * @param $city GTW_Model_City
	 * @param $offer GTW_Model_Offer
	 * @param $returnActiveOnly Boolean
	 *
	 * @return GTW_Model_Offer_Schedule_Collection
	 */
	public function getScheduleByDate(Zend_Date $date, GTW_Model_City $city = null, GTW_Model_Offer $offer=null, $returnActiveOnly = true) 
	{
		return $this->getScheduleByDateRange($date, $date, $city, $offer, $returnActiveOnly);
	}

	/**
	 * Get Schedule in Day Range
	 *
	 * @param $startDate Zend_Date
	 * @param $endDate Zend_Date
	 * @param $city GTW_Model_City
	 * @param $offer GTW_Model_Offer
	 * @param $returnActiveOnly Boolean
	 *
	 * @return GTW_Model_Offer_Schedule_Collection
	 */
	public function getScheduleByDateRange(	Zend_Date $startDate, Zend_Date $endDate, GTW_Model_City $city = null, GTW_Model_Offer $offer=null, $returnActiveOnly = true)
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

		//Offer
		if($offer)
			$request->addFilter('offer_id', '=', $offer->id);

		//Active Schedules Only
		if($returnActiveOnly)
			$request->addFilter('status_id', '=', 2);


		return GTW_Model_Offer_Schedule_Mapper::getInstance()->getCollection($request);
	}

}