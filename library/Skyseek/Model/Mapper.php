<?php
/** 
 * Skyseek License, Version 1.0
 * 
 * This file contains Original Code and/or Modifications of Original Code
 * as defined in and that are subject to the Skyseek License
 * Version 1.0 (the 'License'). You may not use this file except in
 * compliance with the License. Please obtain a copy of the License at
 * http://www.skyseek.com/License/Version1 and read it before using this
 * file.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Skyseek
 * @subpackage ST-ORM
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */



/**
 * Abstract Model Mapper
 *
 * @package    Skyseek
 * @subpackage ST-ORM
 * @author     Sean Thayne <sean@skyseek.com
 */
abstract class Skyseek_Model_Mapper {

	protected $_tableName = '';
    protected $_tableGateway = null;

	public static function getInstance() {
		if(!static::$_instance)
			static::$_instance = new static;

		return static::$_instance;
	}

	public static function resetInstance() {
		static::$_instance = null;
		static::getInstance();
	}

	public function __construct(Zend_Db_Table_Abstract $tableGateway = null) {
		if(is_null($tableGateway))
			$tableGateway = new Zend_Db_Table ($this->_tableName);

		$this->_tableGateway = $tableGateway;
	}

	/**
	 *
	 * @return Zend_Db_Table
	 */
	protected function _getGateway() {
		return $this->_tableGateway;
	}

	/**
	 *
	 * @param String $name
	 * @return Boolean
	 */
	protected  function hasIdentity($name) {
		return isset(static::$_identityMap[$name]);
	}

	/**
	 *
	 * @param String $name
	 * @return Skyseek_Model_Entity
	 */
	protected function getIdentity($name) {
		if(static::hasIdentity($name))
			return static::$_identityMap[$name];
		else
			return null;
	}

	/**
	 *
	 * @param String $name
	 * @param Skyseek_Model_Entity $entity
	 */
	protected function setIdentity($name, Skyseek_Model_Entity $entity) {
		static::$_identityMap[$name] = $entity;
	}
}
