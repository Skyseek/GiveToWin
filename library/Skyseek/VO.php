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
 * @subpackage Core
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

/**
 * Description of Skyseek_VO
 *
 * @package    Skyseek
 * @subpackage Core
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
abstract class Skyseek_VO {

	/**
	 * Base constructor sets properties of a given array
	 *
	 * @param Array|Object $input
	 */
	public function __construct($input=null) {
		if(is_object($input)) {
			$object = $input;
			$input  = array();

			foreach($object as $property=>$value)
				$input[$property] = $value;
		}

		if(is_array($input)) {
			foreach($input as $k=>$v) {
				$method = 'set' . $k;

				if(method_exists($this, $method))
						$this->$method($v);
				else
					$this->$k = $v;
			}
		}
	}

	public function __set($name, $value) {
		$method = 'set' . $name;

		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Property( $name )");
		}

		$this->$method($value);
	}

	public function __get($name) {
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Property( $name )");
		}

		return $this->$method();
	}

	public function __call($method, $arguments) {
		$methods = get_class_methods($this);

		/**
		 * Method Exists, Forward Call
		 */
		if (in_array($method, $methods)) {
			return call_user_func_array(array($this, $method), $arguments);
		}

 		/**
 		 * Method Doesn't Exist, Check For Matching Property
 		 */

		if(strlen($method) > 3) {
			$methodType = substr( $method, 0, 3 );
			$propertyName = strtolower( substr( $method, 3, 1 ) ) . substr( $method, 4 ) ;
			$properties = get_class_vars( get_class( $this ) );

 			if ( array_key_exists( $propertyName, $properties ) ) {

 				if( $methodType == 'get' ) {
 					return $this->$propertyName;
				} else if($methodType == 'set') {
					if( count( $arguments ) > 0 ) {
						return $this->$propertyName = $arguments[0];;
					} else {
						throw new Exception("set{$name}($value) Requires at least one argument.");
					}
				}
			}
 		}

		throw new Exception("Invalid Method Called {$method}");
	}

	/**
	 * Sets Properties From Array, Usefull To Push Data from Database Calls.
	 * This will also use set{propertyName} for properties found with a set{propertyName} method.
	 *
	 * @return Array Array Containg VO Properties.
	 */
	public function setDataArray( Array $options ) {
        $methods = get_class_methods( $this);
        $properties = get_class_vars( get_class( $this ) );

		foreach( $options as $key => $value ) {
			if( array_key_exists( $key, $properties )) {
				$this->$key = $value;
			} else {
				$method = 'set' . ucfirst( $key );
				if ( in_array( $method, $methods ) ) {
					$this->$method( $value );
				}
			}
		}

		return $this;
	}

	/**
	 * Pull Data Array From VO, Usefull Database Calls.
	 * This will also use get{PropertyName} for properties found with a _{PropertyName} format.
	 * When creating the setProperty($value)  functions, remember to camelCase the function name.
	 * You should still use a VOMapper to correctly set the types of variables. Very Important!
	 *
	 * @return Array Array Containg VO Properties.
	 */
	public function getDataArray() {
		$return = array();
		$methods = get_class_methods($this);
		$properties = get_class_vars(get_class($this));

		foreach ($properties as $property=>$blank) {
			if($property{0} == '_') {
				$propName = substr($property,1);
				$method = 'get' . ucfirst($propName);
				if (in_array($method, $methods)) {
					$return[$propName] = $this->$method();
				}
			} else {
				$return[$property] = $this->$property;
			}
		}

		return $return;
	}
}