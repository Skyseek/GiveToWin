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
  * Access Control Plugin
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Auth_Plugin extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request) 
	{
		$acl 	= GTW_Acl::getInstance();
		$user	= GTW_Service_User::getInstance()->getCurrentUser();
		
		$module 		= strtolower($request->module);
		$controller	= strtolower($request->controller);
		$action 		= strtolower($request->action);
	
		
		//Find Resource
		if($acl->has("{$module}:{$controller}")) {
			//Use fine grained resource (if exists)
			$resource = "{$module}:{$controller}";
		} else if($acl->has("{$module}")) {
			//Use module based resource (if exists)
			$resource = "{$module}";
		} else {
			//Resource don't exist.
			return NULL;
		}


		//User has access to content.
		if($acl->isAllowed($user->role->id, $resource, $action))
			return NULL;
			
		//User Doesn't have access. I wonder why???
		if($user->getRole()->id == GTW_Model_User_Role::GUEST) {
			//$request->setModuleName('admin');
			$request->setControllerName('auth');
			$request->setActionName('login');
		} else {
			//$request->setModuleName('admin');
			$request->setControllerName('auth');
			$request->setActionName('denied');
		}
	}
}
