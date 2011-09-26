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
  * Deal Service Layer
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Service_Deal
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Deal
	 */
	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new self();
		
		return self::$_instance;
	}
	
	public function getFundraiserScheduleByCity(GTW_Model_City $city) 
	{
		$fundraiserService = GTW_Service_Fundraiser::getInstance();
		$fundraiserSchedules = $fundraiserService->getScheduleByDate(Zend_Date::now(), $city);

		return $fundraiserSchedules->current();
	}
	
	public function getOfferScheduleByCity(GTW_Model_City $city) 
	{
		$offerService = GTW_Service_Offer::getInstance();
		$offerSchedules = $offerService->getScheduleByDate(Zend_Date::now(), $city);
		
		return $offerSchedules->current();
	}
}
