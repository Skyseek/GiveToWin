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
 * City Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_City extends GTW_Service_Map
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	protected $_session;

	// ----------------------------------
	// 	City Mapper
	// ----------------------------------
	
	protected $_cityMapper;

	/**
	 * Sets the City Mapper
	 * 
	 * @param GTW_Model_City_Mapper $cityMapper
	 */
	public function setCityMapper(GTW_Model_City_Mapper $cityMapper) 
	{
		$this->_cityMapper = $cityMapper;
	}
	
	/**
	 * Gets the City Mapper
	 * 
	 * @return GTW_Model_City_Mapper
	 */
	public function getCityMapper() 
	{
		if(!$this->_cityMapper)
			$this->_cityMapper = GTW_Model_City_Mapper::getInstance();

		return $this->_cityMapper;
	}
	

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
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
	// 	Public Methods
	//
	// ====================================================================
	
	/**
	 * Set Current City 
	 * 
	 * @param $city GTW_Model_City New city to select.
	 *
	 * @return Boolean TRUE on success
	 */
	public function setCitySelection(GTW_Model_City $city) 
	{
		//Set User's City (if logged in)
		if(GTW_Service_User::getInstance()->isLoggedIn()) {
			$user = GTW_Service_User::getInstance()->getCurrentUser();
			$user->city = $city;
			$user->save();
		}
		
		//Store selection in session
		$this->getSession()->cityId = $city->id;

		return true;
	}

	/**
	 * Determine if a city is selected and is not NULL
	 * 
	 * @return Boolean Returns TRUE if City is Selection. FALSE otherwise.
	 */
	public function hasCitySelected() 
	{
		return $this->getSession()->cityId !== null;
	}

	/**
	 * Return selected City (if any selected). Null Otherwise.
	 *
	 * @return GTW_Model_City 
	 */
	public function getCitySelection() 
	{
		if($this->hasCitySelected())
			return $this->getCityById($this->getSession()->cityId);
	} 
	 
	/**
	 * Returns City with given ID.
	 * 
	 * @param $cityId int ID of the city to given.
	 *
	 * @return GTW_Model_City Returns City (if exists), NULL otherwise.
	 */
	public function getCityById($cityId) 
	{
		return GTW_Model_City_Mapper::getInstance()->getCity($cityId);
	}

	/**
	 * Returns Collection of all Cities
	 * 
	 * @param $includeNonActive Boolean Flag for including non-active cities
	 *
	 * @return GTW_Model_City_Collection Collection of Cities
	 */
	public function getCityCollection($includeNonActive=false) 
	{
		$request = new Skyseek_Model_Entity_Collection_Request(1, -1);

		if(!$includeNonActive)
			$request->addFilter('status_id', '=', GTW_Model_City_Status::ACTIVE);

		return GTW_Model_City_Mapper::getInstance()->getCities($request);
	}

	public function hasSubscriber($cityId, $userId) {
		GTW_Model_City_Subscription::getInstance();
	}

	/**
	 *
	 * @return Zend_Session_Namespace
	 */
	public function getSession() {
		if(!$this->_session)
			$this->_session = new Zend_Session_Namespace('org.givetowin.city');

		return $this->_session;
	}


	/**
	 * Saves a City Values
	 *
	 * @param $city GTW_Model_City City Entity to save
	 * 
	 * @return GTW_Model_City Returns the same entity passed in.
	 */
	public function save(GTW_Model_City $city) 
	{
		return $this->getCityMapper()->save($city);
	}

	public function delete(GTW_Model_City $city)
	{
		return $this->getCityMapper()->delete($city);	
	}


	/**
	 * Returns the City Form with loaded City.
	 *
	 * @param $id city_id to search for
	 * 
	 * @return GTW_Model_City City (if exists)
	 */
	public function getForm(GTW_Model_City $city = null) 
	{
		$form = new GTW_Model_City_Form();

		if($city)
			$form->setCity($city);

		return $form;
	}

	public function suggestCity(GTW_Model_City_Suggestion $city)
	{
		$this->sendSuggestionEmail($city);
	}


	// ====================================================================
	//
	// 	Email Functions
	//
	// ====================================================================
	
	public function sendSuggestionEmail(GTW_Model_City_Suggestion $city)
	{
		$emailTemplate	= $this->getEmailService()->getTemplateByName('suggest_city');

		// Assign Template Vars
		$emailTemplate->assign('city', $city);

		//Get Current Admin list
		$admins = $this->getUserService()->getAdmins();

		// Queue Rendered Email
		foreach($admins as $admin) {
			$emailTemplate->assign('user', $admin);
			$this->getEmailService()->queueEmail($emailTemplate->render($admin));
		}
			
	}
}
