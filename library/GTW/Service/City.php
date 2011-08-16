<?php
/** 
 * Givetowin.org License, Version 1.0
 * 
 * You may not modify or use this file except with written permission 
 * from Givetowin.org.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Givetowin.org
 */






/**
 * User
 *
 * @package    Givetowin
 * @author     Sean Thayne <sean@skyseek.com
 * @since      0.1
 */
class GTW_Service_City {
    protected static $_instance;

	/**
	 *
	 * @return GTW_Service_City
	 */
	public static function getInstance() {
		if(!self::$_instance)
			self::$_instance = new self();
		
		return self::$_instance;
	}

	public function hasCitySelected() {
		return false;
	}

	public function getAllCities($includeNonActive=false) {
		$request = new Skyseek_Model_Entity_Collection_Request(1, -1);

		if(!$includeNonActive)
			$request->addFilter('status_id', '=', GTW_Model_City_Status::ACTIVE);

		return GTW_Model_City_Mapper::getInstance()->getCities($request);
	}

	public function subscribeUserToNewsletter($email, $city) {
		$userService = GTW_Service_User::getInstance();
		$user = $userService->getUserByEmail($email);

		if(!$user)
			$user = $userService->createSubscriber($email);

		$subscriberServer = GTW_Service_CitySubscription::getInstance();

	}

	public function hasSubscriber($cityId, $userId) {
		GTW_Model_City_Subscription::getInstance();
	}
}
