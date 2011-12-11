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
 * @subpackage Model
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Filter
 *
 * @package    Skyseek
 * @subpackage Model
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Model_Entity_Collection_Request_Filter 
{
	// ====================================================================
	//
	// 	Filter Types
	//
	// ====================================================================
	
	
	const CONTAIN = 'contain';
	const NOT_CONTAIN = '!contain';
	const EQUAL = '=';
	const NOT_EQUAL = '!=';

	// ====================================================================
	//
	// 	Public Properties
	//
	// ====================================================================
	
	public $columns = array();
	public $value;
	public $type = self::CONTAIN;


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	public function  __construct($columns, $value=null, $type=self::CONTAIN) 
	{
		if(is_array($columns))
			$this->columns += $columns;
		else
			$this->columns += array($columns);
		
		$this->value = $value;
		$this->type = $type;
	}
}


