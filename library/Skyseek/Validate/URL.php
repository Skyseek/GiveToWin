<?php
/** 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * URL
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Validate_URL
	extends Zend_Validate_Abstract {

	const INVALID_URL = 'invalidUrl';

	protected $_messageTemplates = array(
		self::INVALID_URL => "'%value%' is not a valid URL.",
	);

	public function isValid($value) {
		$valueString = (string) $value;
		$this->_setValue($valueString);

		if (!Zend_Uri::check($value)) {
			$this->_error(self::INVALID_URL);
			return false;
		} else {
			return true;
		}
	}
}
