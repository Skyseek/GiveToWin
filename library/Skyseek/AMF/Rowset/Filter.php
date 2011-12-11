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
 * @subpackage AMF
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

/**
 * Description of Skyseek_AMF_Rowset_Filter
 *
 * @package    Skyseek
 * @subpackage AMF
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
define('DB_IS_LIKE', 1);
define('DB_IS_NOT_LIKE', 2);
define('DB_IS', 3);
define('DB_IS_NOT', 4);

class Skyseek_AMF_Rowset_Filter {
	public $filterColumns = array();
	public $filterValue;
	public $filterType = 1;

	public function  __construct(array $columns=array(), $value=null, $type=DB_IS_LIKE) {
		$this->filterColumns = $columns;
		$this->filterValue = $value;
		$this->filterType = $type;
	}

	public function  __toString() {
		$strings = array();
		$value = mysql_escape_string($this->filterValue);

		foreach($this->filterColumns as $column) {
			$column = mysql_escape_string($column);

			switch($this->filterType) {
				case DB_IS_LIKE:
					$strings[] = "`$column` LIKE '%$value%'";
					break;

				case DB_IS_NOT_LIKE:
					$strings[] = "`$column` NOT LIKE '%$value%'";
					break;

				case DB_IS:
					if($value === null)
						$strings[] = "`$column` IS NULL";
					else
						$strings[] = "`$column` = '$value'";
					break;

				case DB_IS_NOT:
					if($value === null)
						$strings[] = "`$column` IS NOT NULL";
					else
						$strings[] = "`$column` != '$value'";
					break;
			}
		}

		return '(' .  implode(' OR ', $strings) . ')';
	}
}