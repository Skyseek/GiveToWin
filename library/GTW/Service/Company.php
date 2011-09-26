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
 * Company Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_Company extends GTW_Service_Map
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Service_Company
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
	 * Returns the Company Entity with given id.
	 *
	 * @param $id company_id to search for
	 * 
	 * @return GTW_Model_Company Company (if exists)
	 */
	public function getCompanyById($id) 
	{
		return $this->getCompanyMapper()->getCompany($id);
	}


	/**
	 * Saves a Company Values
	 *
	 * @param $company GTW_Model_Company Company Entity to save
	 * 
	 * @return GTW_Model_Company Returns the same entity passed in.
	 */
	public function save(GTW_Model_Company $company) 
	{
		return $this->getCompanyMapper()->save($company);
	}

	public function delete(GTW_Model_Company $company) 
	{
		return $this->getCompanyMapper()->delete($company);
	}


	/**
	 * Returns the Company Form with loaded Company.
	 *
	 * @param $id company_id to search for
	 * 
	 * @return GTW_Model_Company Company (if exists)
	 */
	public function getForm(GTW_Model_Company $company = null) 
	{
		$form = new GTW_Model_Company_Form();

		if($company)
			$form->setCompany($company);

		return $form;
	}


	public function suggestCompany(GTW_Model_Company_Suggestion $company)
	{
		$this->sendSuggestionEmail($company);
	}


	// ====================================================================
	//
	// 	Email Functions
	//
	// ====================================================================
	
	public function sendSuggestionEmail(GTW_Model_Company_Suggestion $company)
	{
		$emailTemplate	= $this->getEmailService()->getTemplateByName('suggest_company_staff');

		// Assign Template Vars
		$emailTemplate->assign('company', $company);

		//Get Current Admin list
		$admins = $this->getUserService()->getAdmins();

		// Queue Rendered Email
		foreach($admins as $admin) {
			$emailTemplate->assign('user', $admin);
			$this->getEmailService()->queueEmail($emailTemplate->render($admin));
		}
			
	}
}