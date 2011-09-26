<?php

class Skyseek_Form_Message extends Zend_Form_Element_Xhtml 
{

	protected $_showCloseButton = true;
	protected $_messageType = 'warning';
	protected $_message = '';


	public function  __construct($spec, $options = null) 
	{
		parent::__construct($spec, $options);

		if(isset($options['message']))
			$this->_message = $options['message'];

		if(isset($options['messageType']))
			$this->_messageType = $options['messageType'];

		if(isset($options['showClose']))
			$this->_showCloseButton = (bool) $options['showClose'];
	}

	public function render() 
	{
		if($this->_showCloseButton)
			return <<<HTML
			<ul class="message {$this->_messageType} no-margin">
				<li>{$this->_message}</li>
				<li class="close-bt"></li>
			</ul>
HTML;
		else
			return <<<HTML
			<ul class="message {$this->_messageType} no-margin">
				<li>{$this->_message}</li>
			</ul>
HTML;
	}

	public function isValid($value)
	{
		return true;
	}
}