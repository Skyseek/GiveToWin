<?php

class Skyseek_Asset_Loader
{
	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	

	private static $_instance;

	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================

	// ----------------------------------
	// 	Asset Path
	// ----------------------------------
	
	protected $_assetPath = true;

	public function setAssetPath($assetPath) 
	{
		$this->_assetPath = $assetPath;
	}

	// ----------------------------------
	// 	Minify Scripts?
	// ----------------------------------
	
	protected $_compressAssets = false;

	public function compressAssets($compressAssets = true) 
	{
		$this->_compressAssets = (bool) $compressAssets;
	}


	// ----------------------------------
	// 	Javascript Assets
	// ----------------------------------
	
	protected $_jsAssets	= array();

	public function addJs($scriptUrl)
	{
		$this->_jsAssets[] = $scriptUrl;		
	}


	// ----------------------------------
	// 	Cascading Style Sheet Assets
	// ----------------------------------
	
	protected $_cssAssets	= array();

	public function addCss($styleSheetUrl)
	{
		$this->_cssAssets[] = $styleSheetUrl;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	
	public function getCss() 
	{
		if($this->_compressAssets)
			return $this->_createLink($this->_assetPath . '/css/mini.php?files=' . implode(',', $this->_cssAssets));
		
		$return = '';

		foreach($this->_cssAssets as $asset)
			$return .= $this->_createLink($this->_assetPath . '/css/' . $asset . '.css');

		return $return;
	}

	public function getJs() 
	{
		if($this->_compressAssets)
			return $this->_createLink($this->_assetPath . '/js/mini.php?files=' . implode(',', $this->_jsAssets));
		
		$return = '';

		foreach($this->_jsAssets as $asset)
			$return .= $this->_createScript($this->_assetPath . '/js/' . $asset . '.js');

		return $return;
	}

	protected function _createLink($path) 
	{
		return "<link rel='stylesheet' href='{$path}' type='text/css' media='screen' />";
	}

	protected function _createScript($path) 
	{
		return "<script type='text/javascript' src='{$path}'></script>";
	}
}