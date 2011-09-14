<?php


class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

	protected function _initAutoLoader() {
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$autoLoader->registerNamespace('GTW');
		$autoLoader->registerNamespace('Skyseek');
	}

	protected function _initVersionConstant() {
		define('GTW_VERSION', '0.5');
	}

	protected function _initLayout() {
		Zend_Layout::startMvc(array(
			'pluginClass' => 'GTW_Layout_Plugin'
		));
	}

}

