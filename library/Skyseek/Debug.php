<?php

/**
 * Skyseek_Debug
 *
 * @package    Skyseek
 * @subpackage Development_Tools
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Debug {

	public static function printArray($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

}