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
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 */




/**
 * Access Control List
 *
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
 
class GTW_Acl extends Zend_Acl
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 *
	 * @return GTW_Acl
	 */
	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new self();
		
		return self::$_instance;
	}
	
	
	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	
	public function __construct()
	{
		
		// ----------------------------------
		// 	Role Types
		// ----------------------------------		
		
		$this->addRole(new Zend_Acl_Role(GTW_Model_User_Role::GUEST));
		$this->addRole(new Zend_Acl_Role(GTW_Model_User_Role::SUBSCRIBER), GTW_Model_User_Role::GUEST);
		$this->addRole(new Zend_Acl_Role(GTW_Model_User_Role::MEMBER), GTW_Model_User_Role::SUBSCRIBER);
		$this->addRole(new Zend_Acl_Role(GTW_Model_User_Role::ADMIN), GTW_Model_User_Role::MEMBER);
		
		
		// ----------------------------------
		// 	Resource: Default Module - Front End
		// ----------------------------------
		
		$this	->add(new Zend_Acl_Resource('default'))
				->add(new Zend_Acl_Resource('default:index'), 'default')
				->add(new Zend_Acl_Resource('default:city'), 'default')
				->add(new Zend_Acl_Resource('default:user'), 'default');
		
		$this->allow(GTW_Model_User_Role::GUEST,  'default:index');
		$this->allow(GTW_Model_User_Role::MEMBER,  'default:user', array('account', 'logout'));
		
		// ----------------------------------
		// 	Resource: Admin Module
		// ----------------------------------
		
		$this	->add(new Zend_Acl_Resource('admin'))
				->add(new Zend_Acl_Resource('admin:auth'), 'admin')
				->add(new Zend_Acl_Resource('admin:email'), 'admin')
				->add(new Zend_Acl_Resource('admin:companies'), 'admin')
				->add(new Zend_Acl_Resource('admin:email-template'), 'admin');
		
		$this->allow(GTW_Model_User_Role::GUEST,  'admin:auth', array('login'));
		$this->allow(GTW_Model_User_Role::ADMIN,  'admin');

	}
}
