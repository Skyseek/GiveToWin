<?php
/** 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Uniform
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Form_Decorator_Uniform
	extends Zend_Form_Decorator_Abstract {

	public function render($content) {
		$element = $this->getElement();
		$action  = $element->getAction();
		$method  = $element->getMethod();

		if ($method == Zend_Form::METHOD_POST) {
			$this->setOption('enctype', 'application/x-www-form-urlencoded');
		}
		
		$title       = $this->getOption('title');
		$encType     = $this->getOption('enctype');
		$errorLiTags = null;
		$errors      = $element->getErrors();
		$errors      = $element->getErrors();

		if(count($errors)) {
			//Skyseek_Debug::printArray($errors);
		}


		$return  = "<form action='$action' enctype='$encType' method='$method' class='uniForm'>\n";

		if($errorLiTags)
		$return .= "<div id='errorMsg'><h3>Sorry, this form needs corrections.</h3><ol><li>$errorLiTags</li></ol></div>";

		$return .= "\t<fieldset>\n";
		
		if($title)
		$return .= "\t\t<h3>$title</h3>\n";

		$return .= $content;
		$return .= "\t</fieldset>\n";
        $return .= "\t<div class='buttonHolder'>\n";

		foreach($this->getElement()->getElements() as $element) {
			if($element instanceof Zend_Form_Element_Submit) {
				$label = $element->getLabel();
				$value = $element->getValue();
				$name  = $element->getName();
				$class = $element->getDecorator('UniformElements')->getOption('class');
				$type  = $element instanceof Zend_Form_Element_Button ? 'button' : 'submit';
				$click = $element->getDecorator('UniformElements')->getOption('click');

				$return .= "\t\t<button onclick='$click' name='$name' value='$value' type='$type' class='$class'>$label</button>\n";
			}
		}

        $return .= "\t</div>\n";
		$return .= "</form>\n";
		

		return $return;
	}

}
