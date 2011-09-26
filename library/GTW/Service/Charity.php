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
class GTW_Service_Charity extends GTW_Service_Map
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

	public function delete(GTW_Model_Charity $charity)
	{
		return $this->getCharityMapper()->delete($charity);
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


	public function suggestCharity(GTW_Model_Charity_Suggestion $charity)
	{
		$this->sendSuggestionEmail($charity);
	}


	// ====================================================================
	//
	// 	Email Functions
	//
	// ====================================================================
	
	public function sendSuggestionEmail(GTW_Model_Charity_Suggestion $charity)
	{
		$emailTemplate	= $this->getEmailService()->getTemplateByName('suggest_charity_staff');

		// Assign Template Vars
		$emailTemplate->assign('charity', $charity);

		//Get Current Admin list
		$admins = $this->getUserService()->getAdmins();

		// Queue Rendered Email
		foreach($admins as $admin) {
			$emailTemplate->assign('user', $admin);
			$this->getEmailService()->queueEmail($emailTemplate->render($admin));
		}
			
	}
}