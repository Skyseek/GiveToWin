<?php
/**
 * Givetowin.org License, Version 1.0
 *
 * You may not modify or use this file except with written permission
 * from Give to Win, Inc.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND Give to Win HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 */
 

/**
 * Module Layout Plugin
 *
 * @author     Sean Thayne <sean@skyseek.com> http://www.skyseek.com
 * @author     Daniel Cousineau <dcousineau@gmail.com> http://www.toosweettobesour.com/ 
 */
class GTW_Layout_Plugin extends Zend_Layout_Controller_Plugin_Layout 
{
	public function preDispatch(Zend_Controller_Request_Abstract $request) 
	{
		$this->_setLayoutPath($request);
		$this->_setErrorController($request);
	}

	protected function _setLayoutPath(Zend_Controller_Request_Abstract $request)
	{
		$layoutPath  = APPLICATION_PATH;
		$layoutPath .= DIRECTORY_SEPARATOR . "modules";
		$layoutPath .= DIRECTORY_SEPARATOR . $request->getModuleName();
		$layoutPath .= DIRECTORY_SEPARATOR . "layouts";
		$layoutPath .= DIRECTORY_SEPARATOR . "scripts";

		Zend_Layout::getMvcInstance()->setLayoutPath($layoutPath);
	}

	protected function _setErrorController(Zend_Controller_Request_Abstract $request)
	{
		$front = Zend_Controller_Front::getInstance();
		$errorHandler = $front->getPlugin('Zend_Controller_Plugin_ErrorHandler');

		//If the ErrorHandler plugin is not registered, bail out
		if(!($errorHandler instanceOf Zend_Controller_Plugin_ErrorHandler))
			return;

		//Generate a test request to use to determine if the error controller in our module exists
		$testRequest = new Zend_Controller_Request_HTTP();
		$testRequest->setModuleName($request->getModuleName())
					->setControllerName($errorHandler->getErrorHandlerController())
					->setActionName($errorHandler->getErrorHandlerAction());
					
		//Does the controller even exist?  
		if($front->getDispatcher()->isDispatchable($testRequest))
			$errorHandler->setErrorHandlerModule($request->getModuleName());
	}
}
