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
 * Plugin
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Layout_Plugin extends Zend_Layout_Controller_Plugin_Layout {
    public function preDispatch(Zend_Controller_Request_Abstract $request) {

		$layoutPath  = APPLICATION_PATH;
		$layoutPath .= DIRECTORY_SEPARATOR . "modules";
		$layoutPath .= DIRECTORY_SEPARATOR . $request->getModuleName();
		$layoutPath .= DIRECTORY_SEPARATOR . "layouts";
		$layoutPath .= DIRECTORY_SEPARATOR . "scripts";

		Zend_Layout::getMvcInstance()->setLayoutPath($layoutPath);

	}
}
