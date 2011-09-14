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
 * User Role Entity
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Givetowin.org
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User_Role extends Skyseek_Model_Entity {
	const GUEST			= 1;
	const SUBSCRIBER	= 2;
	const MEMBER		= 3;
	const ADMIN			= 4;

    protected $_mapper = 'GTW_Model_User_Role_Mapper';

	public $id;
	public $role;
	public $description;
}
