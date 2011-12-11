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
 * @subpackage DB
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

/**
 * Skyseek_DB_Table
 *
 * @package    Skyseek
 * @subpackage DB
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_DB_Table extends Zend_Db_Table_Abstract {

	public function  __construct($tableName=false, $primaryID=false) {
		if($tableName)
			$this->_name = $tableName;

		if($primaryID)
			$this->_primary = $primaryID;

		parent::__construct();
	}

	public function getVO($vo, $where=false) {
		if(is_string($vo))
			$vo = new $vo();

		if(!$vo instanceof Skyseek_VO)
			throw new Skyseek_Exception("Invalid Input '$vo' Expecting String|Skyseek_VO");

		if(!$where)
			$where = $this->buildWhereStatement ($vo);

		$data = $this->fetchRow($where);

		if($data) {
			$vo->setDataArray($data->toArray());
			return $vo;
		}

		return false;
	}

	public function insertVO(Skyseek_VO $vo) {
		return $this->insert($vo->getDataArray());
	}

	public function deleteVO(Skyseek_VO $vo) {
		return $this->delete($this->buildWhereStatement($vo));
	}

	public function updateVO(Skyseek_VO $vo) {
		return $this->update($vo->getDataArray(), $this->buildWhereStatement($vo));
	}

	private function buildWhereStatement(Skyseek_VO $vo) {
		if ($this->_primary == null)
			$this->_setupPrimaryKey();

		if(!is_array($this->_primary))
				$this->_primary = array($this->_primary);

		$keys = array();
		foreach ($this->_primary as $primary) {
			$value = mysql_escape_string($vo->$primary);
			$keys[] = "`$primary`='$value'";
		}

		return implode(' AND ', $keys);
	}

}