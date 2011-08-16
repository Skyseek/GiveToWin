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
 * CitySubscription
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_CitySubscription {
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

    public function cityHasUserSubscriber($cityId, GTW_Model_User $user) {

	}

	public function addSubscriberToCity($cityId, $email) {
		$user = GTW_Service_User::getInstance()->getSubscriberByEmail($email, true);
		$city = GTW_Service_City::getInstance()->getCityById($cityId);
	}
}
