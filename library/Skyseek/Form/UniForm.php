<?php
/** 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * UniForm
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Form_UniForm extends
	Zend_Form {

	protected $_title;

	public function __construct($options = null) {
		$this->addPrefixPath('Skyseek_Form_Decorator', 'Skyseek/Form/Decorator', 'decorator');
		$this->setMethod("POST");
		$this->setDisableLoadDefaultDecorators(true);
		parent::__construct($options);
		
	}

	public function setTitle($title) {
		$this->_title = $title;
	}

	public function loadDefaultDecorators() {
		//$this->setElementDecorators(array('UniformElements'));
		$this->setDecorators(array('FormElements',array('Uniform', array('title'=>$this->_title))));
	}

	public function  createElement($type, $name, $options = array()) {
		$options['decorators'] = array('UniformElements');
		$element = parent::createElement($type, $name, $options);

		$this->addElement($element);

		$element->getDecorator('UniformElements')->setOptions($options);

		return $element;
	}
}
