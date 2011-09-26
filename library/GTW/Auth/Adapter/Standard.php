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
  * Standard Auth Adapter
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Auth_Adapter_Standard extends Zend_Auth_Adapter_DbTable
{
	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	
	public function __construct(GTW_Model_User $user) 
	{
		parent::__construct(
			Zend_Db_Table::getDefaultAdapter(),
			'user',
			'email',
			'password',
			'MD5(?)'
		);
		
		$this->setIdentity($user->email);
		$this->setCredential($user->password);
	}

	public function  getResultRowObject($returnColumns = null, $omitColumns = null)
	{
		$userId = current(parent::getResultRowObject('id'));
		return GTW_Model_User_Mapper::getInstance()->getUser($userId);
	}
}
