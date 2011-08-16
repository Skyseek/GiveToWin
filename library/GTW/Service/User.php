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
 */
class GTW_Service_User {

    protected static $_instance;

	/**
	 * @return GTW_Service_User
	 */
	public static function getInstance() {
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	public static function getSubscriberByEmail($email, $createIfNonExistant=true) {
		$user = $this->getUserByEmail($email);

		if(!$user && $createIfNonExistant)
			$user = $this->createSubscriber($email);

		return $user;
	}

	public static function createSubscriber($email) {
		$user = new GTW_Model_User(array('email'=>$email));
		$user->referenceId('role_id', GTW_Model_User_Role::SUBSCRIBER);
		$user->referenceId('status_id', GTW_Model_User_Status::SUBSCRIBER);
		$user->save();

		return $user;
	}

	public static function getUserByEmail($email) {
		$request = new Skyseek_Model_Entity_Collection_Request(1, 1);
		$request->addFilter('email', '=', $email);

		return GTW_Model_User_Mapper::getInstance()->getUserCollection($request)->current();
	}
}
