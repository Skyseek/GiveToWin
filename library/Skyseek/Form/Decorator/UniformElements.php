<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Decorator
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Form_Decorator_Abstract */
require_once 'Zend/Form/Decorator/Abstract.php';

/**
 * Zend_Form_Decorator_DtDdWrapper
 *
 * Creates an empty <dt> item, and wraps the content in a <dd>. Used as a
 * default decorator for subforms and display groups.
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Decorator
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: DtDdWrapper.php 23775 2011-03-01 17:25:24Z ralph $
 */
class Skyseek_Form_Decorator_UniformElements extends Zend_Form_Decorator_Abstract
{
    /**
     * Default placement: surround content
     * @var string
     */
    protected $_placement = null;

    /**
     * Render
     *
     * Renders as the following:
     * <dt>$dtLabel</dt>
     * <dd>$content</dd>
     *
     * $dtLabel can be set via 'dtLabel' option, defaults to '\&#160;'
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
		$element = $this->getElement();
		$classArray = $this->buildValidationClassArray($element);

		if($element instanceof Zend_Form_Element_Text)
			return $this->wrapInput($element, $this->renderTextElement($element, $classArray));
		else if($element instanceof Zend_Form_Element_Textarea)
			return $this->wrapInput($element, $this->renderTextareaElement($element, $classArray));
		else if($element instanceof Zend_Form_Element_Password)
			return $this->wrapInput($element, $this->renderPasswordElement($element, $classArray));
		else if($element instanceof Zend_Form_Element_Checkbox)
			return $this->wrapInput($element, $this->renderCheckboxElement($element, $classArray), true);
		else if($element instanceof Zend_Form_Element_Submit)
			return '';
		else if($element instanceof Zend_Form_Element_Hash)
			return '<input type="hidden" name="' . $element->getName() . '" value="' . $element->getValue() . '" />';
		else if($element instanceof Zend_Form_Element_Hidden)
			return '<input type="hidden" name="' . $element->getName() . '" value="' . $element->getValue() . '" />';
		
		echo "WTF:<pre>" . print_r($element, true);
		exit;
    }

	private function renderTextElement(Zend_Form_Element_Text $element, array $classArray) {

		$classArray[] = 'textinput';
		$classes = implode(' ', $classArray);

		$name  = $element->getName();
		$value = $element->getValue();
		$title = $this->getOption('title');

		return "<input name='$name' id='$name' data-default-value='$title' value='$value' size='35' maxlength='50' type='text' class='$classes'/>";
	}

	private function renderTextareaElement(Zend_Form_Element_Textarea $element, array $classArray) {

		$classArray[] = '';
		$classes = implode(' ', $classArray);

		$name  = $element->getName();
		$value = $element->getValue();
		$title = $this->getOption('title');

		return "<textarea name='$name' id='$name' data-default-value='$title' value='$value'  type='text' class='$classes'></textarea>";
	}

	private function renderPasswordElement(Zend_Form_Element_Password $element, array $classArray) {

		$classArray[] = 'textinput';
		$classes = implode(' ', $classArray);

		$name  = $element->getName();
		$value = $element->getValue();
		$title = $this->getOption('title');

		return "<input name='$name' id='$name'  data-default-value='$title' value='$value' size='35' maxlength='50' type='password' class='$classes'/>";
	}

	private function renderCheckboxElement(Zend_Form_Element_Checkbox $element, array $classArray) {

		$classArray[] = 'textinput';
		$classes = implode(' ', $classArray);

		$name  = $element->getName();
		$title = $this->getOption('title');
		$selected = $element->getValue() ? 'selected' : '';

		return "<li class='blockLabels'><lable for='$name'><input name='$name' id='$name' $selected type='checkbox' class='$classes'/> $title</lable></li>";
	}


	private function buildValidationClassArray($element) {
		$classes = array();

		if($element->isRequired())
			$classes[] = 'required';

		$validators  = $element->getValidators();

		foreach($validators as $validator) {
			//Emails
			if($validator instanceof Zend_Validate_EmailAddress)
				$classes[] = 'validateEmail';

			//Date
			if($validator instanceof Zend_Validate_Date)
				$classes[] = 'validateDate';

			//URls
			if($validator instanceof Skyseek_Validate_URL)
				$classes[] = 'validateUrl';

			//Same As
			if($validator instanceof Zend_Validate_Identical) {
				$classes[] = 'validateSameAs';
				$classes[] = $validator->getToken();
			}

			//Max / Min
			else if($validator instanceof Zend_Validate_StringLength) {
				$min = $validator->getMin();
				$max = $validator->getMax();

				if($min !== null) {
					$classes[] = 'validateMinLength';
					$classes[] = 'val-' . $min;
				}

				if($max !== null) {
					$classes[] = 'validateMaxLength';
					$classes[] = 'val-' . $max;
				}
			}

			//Alphabit
			else if($validator instanceof Zend_Validate_Alpha) {
				$classes[] = 'validateAlpha';
			}

			//Alphabit / Numbers
			else if($validator instanceof Zend_Validate_Alnum) {
				$classes[] = 'validateAlphaNum';
			}

			//Numbers
			else if($validator instanceof Zend_Validate_Digits) {
				$classes[] = 'validateNumber';
			}

			//Greater than
			else if($validator instanceof Zend_Validate_GreaterThan) {
				$classes[] = 'validateMin';
				$classes[] = 'val-' . $validator->getMin();
			}

			//Less than
			else if($validator instanceof Zend_Validate_LessThan) {
				$classes[] = 'validateMax';
				$classes[] = 'val-' . $validator->getMax();
			}

		}

		return $classes;
	}

	private function wrapInput(Zend_Form_Element $element, $content, $useParagraphLabel=false) {
		$name        = $element->getName();
		$label       = $element->getLabel();
		$description = $element->getDescription();
		$requireStar = $element->isRequired() ? '<em>*</em>' : '';
		$messages    = $element->getMessages();
		$classes     = array('ctrlHolder');

		if(count($element->getErrors())) {
			//Shit we got errors son!

			$errorMessages = array();

			foreach($element->getErrors() as $errorIndex) {
				if(isset($messages[$errorIndex]))
					$errorMessages[] = $messages[$errorIndex];
			}

			if(count($errorMessages)) {
				$classes [] = 'error';
				$description = implode('<br />', $errorMessages);
			}
		}

		$return  = "\t\t<div class='" . implode(' ', $classes) . "'>\n";

		if($useParagraphLabel) {
			$return .= "\t\t\t<p class='label'>$label</p>\n";
			$return .= "\t\t\t<ul class='blockLabels'>\n";
			$return .= "\t\t\t\t$content\n";
			$return .= "\t\t\t</ul><p class='formHint'>$description</p>\n";
		} else {
			$return .= "\t\t\t<label for='$name'>{$requireStar}{$label}</label>\n";
			$return .= "\t\t\t$content";
			$return .= "\t\t\t<p class='formHint'>$description</p>\n";
		}

		$return .= "\t\t</div>\n";

		return $return;
	}
}
