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
 * Test Case
 *
 * @package    Skyseek
 * @subpackage Test
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Test_Case extends PHPUnit_Framework_TestCase {
    protected function _getCleanMock($className) {
		$class = new ReflectionClass($className);
		$methods = $class->getMethods();
		$stubMethods = array();

		foreach ($methods as $method)
			if ($method->isPublic() || ($method->isProtected() && $method->isAbstract()))
				$stubMethods[] = $method->getName();

		$mocked = $this->getMock(
			$className,
			$stubMethods,
			array(),
			$className . '_EntryMapperTestMock_' . uniqid(),
			false
		);

		return $mocked;
	}
}
