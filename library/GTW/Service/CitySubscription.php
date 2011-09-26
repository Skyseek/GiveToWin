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
 * Service Layer for City Subscriptions
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_CitySubscription 
{
	// ====================================================================
	//
	// 	Singleton Pattern
	//
	// ====================================================================
	
	
	protected static $_instance;
	
	/**
	 * Returns the Singleton Instance of this Object.
	 *
	 * @return GTW_Service_City
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
	// 	Subscription Mapper
	// ----------------------------------
	
	protected $_subscriptionMapper;

	/**
	 * Sets the City Subcription Mapper
	 *
	 * @param GTW_Model_City_Subscription_Mapper $subscriptionMapper
	 */
	public function setSubscriptionMapper(GTW_Model_City_Subscription_Mapper $subscriptionMapper) 
	{
		$this->_subscriptionMapper = $subscriptionMapper;
	}

	/**
	 * Gets the City Subcription Mapper
	 *
	 * @return GTW_Model_City_Subscription_Mapper
	 */
	public function getSubscriptionMapper() 
	{
		if (!$this->_subscriptionMapper)
			$this->_subscriptionMapper = GTW_Model_City_Subscription_Mapper::getInstance();
		
		return $this->_subscriptionMapper;
	}
	
	
	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Returns City Subscription for given city/user combination, if one exists.
	 * 
	 * @param GTW_Model_City $city
	 * @param GTW_Model_User $user
	 *
	 * @return GTW_Model_City_Subscription City's User Subscription. If Exists.
	 */
	public function getCityUserSubscription(GTW_Model_City $city, GTW_Model_User $user) 
	{
		//Create Request.
		$request = new Skyseek_Model_Entity_Collection_Request();
		$request->addFilter('city_id', '=', $city->id);
		$request->addFilter('user_id', '=', $user->id);

		//Get Results
		$results = $this->getSubscriptionMapper()->getSubscriptionCollection($request);

		if($results->count() === 1)
			return $results->current();
	}

	public function getCitySubscriptionsForUser(GTW_Model_User $user)
	{
		//Create Request.
		$request = new Skyseek_Model_Entity_Collection_Request();
		$request->addFilter('user_id', '=', $user->id);

		//Get Results
		$results = $this->getSubscriptionMapper()->getSubscriptionCollection($request);

		return $results;
	}

	/**
	 * Adds Subscriber to City's Newsletter.
	 *
	 * @param $user GTW_Model_User User to subscribe with.
	 * @param $city GTW_Model_City City to add subscription to.
	 *
	 * @return GTW_Model_City_Subscription The newly created subcription.
	 */
	public function addSubscriberToCity(GTW_Model_User $user, GTW_Model_City $city) 
	{
		$existingSubscription = $this->getCityUserSubscription($city, $user);
		
		if($existingSubscription) {
			GTW_Messenger::getInstance()->addMessage('Already Subscribed!', NULL, 'notice');
			return $existingSubscription;
		}
	
		//Create New Subscription.
		$subscription = new GTW_Model_City_Subscription();
		$subscription->setCity($city);
		$subscription->setUser($user);
		
		//Save Subscription.
		$this->getSubscriptionMapper()->save($subscription);
		GTW_Messenger::getInstance()->addMessage('Subscription Created!');

		return $subscription;
	}
	
	/**
	 * Returns Collection of all User's Subscriptions.
	 *
	 * @param $user GTW_Model_User
	 * @param $page Page Number of Collection
	 * @param $perPage How many entities per page.
	 *
	 * @return GTW_Model_City_Subscription_Collection
	 */
	public function getUserSubscriptions(GTW_Model_User $user, $page=1, $perPage=25) 
	{
		//Create Request.
		$request = new Skyseek_Model_Entity_Collection_Request($page, $perPage);
		$request->addFilter('user_id', '=', $user->id);
		
		//Get Results
		$results = $this->getSubscriptionMapper()->getSubscriptionCollection($request);
		
		return $results;
	}
	
	/**
	 * Returns Collection of all City's Subscriptions.
	 *
	 * @param $city GTW_Model_City
	 * @param $page Page Number of Collection
	 * @param $perPage How many entities per page.
	 *
	 * @return GTW_Model_City_Subscription_Collection
	 */
	public function getCitySubscriptions(GTW_Model_City $city, $page=1, $perPage=25) 
	{
		//Create Request.
		$request = new Skyseek_Model_Entity_Collection_Request($page, $perPage);
		$request->addFilter('city_id', '=', $city->id);
		
		//Get Results
		$results = $this->getSubscriptionMapper()->getSubscriptionCollection($request);
		
		return $results;
	}
	
	public function deleteSubscriptionById($id) 
	{
		$subscription = $this->getSubscriptionMapper()->getSubscription($id);

		if($subscription)
			$this->deleteSubscription($subscription);
	}

	/**
	 * Delete a Subscription
	 *
	 * @param $subcription GTW_Model_Subscription
	 */
	public function deleteSubscription(GTW_Model_City_Subscription $subscription) 
	{
		$this->getSubscriptionMapper()->delete($subscription);
	}
}
