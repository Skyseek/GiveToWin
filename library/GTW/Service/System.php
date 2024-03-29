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
 * Email
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_System extends GTW_Service_Map {

    protected static $_instance;

	/**
	 * @return GTW_Service_Email
	 */
	public static function getInstance() {
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	public function submitContactUsMessage(GTW_Model_Contact_Message $message)
	{
		$this->sendContactUsMessage($message);
	}

	// ====================================================================
	//
	// 	Email Functions
	//
	// ====================================================================
	
	public function sendContactUsMessage(GTW_Model_Contact_Message $message)
	{
		$emailTemplate	= $this->getEmailService()->getTemplateByName('contact_us_staff');

		// Assign Template Vars
		$emailTemplate->assign('message', $message);

		//Get Current Admin list
		$admins = $this->getUserService()->getAdmins();

		// Queue Rendered Email
		foreach($admins as $admin) {
			$emailTemplate->assign('user', $admin);
			$this->getEmailService()->queueEmail($emailTemplate->render($admin));
		}
			
	}
}
