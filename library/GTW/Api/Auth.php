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
  * User API
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Api_Auth
{
	public function login($email, $password, $module='default')
	{
		$userService = GTW_Service_User::getInstance();
				
		if(!$userService->login($email, $password)) {
			$response = new GTW_Api_Response(false);
			$response->messages[] = current(GTW_Messenger::getInstance()->getMessages())->body;

			return $response;
		}

		$user = $userService->getCurrentUser();

		if(!GTW_Acl::getInstance()->isAllowed($user->role->id, $module)) {
			$response = new GTW_Api_Response(false);
			$response->messages[] = "Your not allowed in this module.";

			return $response;
		}
		
		return new GTW_Api_Response(true, array('redirect' => "/{$module}/"));
	}
}

class GTW_Api_Response 
{
	public $success;
	public $data;
	public $messages;
	
	public function __construct($success, $data=null)
	{
		$this->success	= $success;
		$this->data		= $data;
	}
}
