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
 * @subpackage iTunes
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Db
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect extends Skyseek_Model_Entity_Collection_Request_Adapter_Abstract {
    public function applyRequest(Zend_Db_Select $select) {
    	
		if(count($this->_request->getFilters()))
			$select->where (implode(' AND ', $this->getCompiledFilters()));

		if($this->_request->getOrderBy())
			$select->order($this->_request->getOrderBy());
	}

	public function getCompiledFilters() {
		$filters = array();

		foreach($this->_request->getFilters() as $filter)
			$filters[] = $this->compileFilter($filter);

		return $filters;
	}

	public function compileFilter(Skyseek_Model_Entity_Collection_Request_Filter $filter) {

		$strings = array();
		$value = $filter->value;

		if($filter->value !== null)
			$value = mysql_escape_string($filter->value);

		foreach($filter->columns as $column) {
			$column = mysql_escape_string($column);

			switch($filter->type) {
				case Skyseek_Model_Entity_Collection_Request_Filter::CONTAIN:
					$strings[] = "`$column` LIKE '%$value%'";
					break;

				case Skyseek_Model_Entity_Collection_Request_Filter::NOT_CONTAIN:
					$strings[] = "`$column` NOT LIKE '%$value%'";
					break;

				case Skyseek_Model_Entity_Collection_Request_Filter::EQUAL:
					if($value === null)
						$strings[] = "`$column` IS NULL";
					else
						$strings[] = "`$column` = '$value'";
					break;

				case Skyseek_Model_Entity_Collection_Request_Filter::NOT_EQUAL:
					if($value === null)
						$strings[] = "`$column` IS NOT NULL";
					else
						$strings[] = "`$column` != '$value'";
					break;

				default:
					$strings[] = "`$column` {$filter->type} '$value'";
			}
		}

		return '(' .  implode(' OR ', $strings) . ')';
	}
}
