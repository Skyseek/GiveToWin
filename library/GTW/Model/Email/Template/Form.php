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
 * Form
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Email_Template_Form extends Zend_Form 
{
	// ====================================================================
	//
	// 	Properties
	//
	// ====================================================================
	
	
	// ----------------------------------
	// 	Template
	// ----------------------------------
	
	
	protected $_template;

	public function setTemplate(GTW_Model_Email_Template $template) 
	{
		$this->populate($template->toArray());
		$this->_template = $template;
	}

	public function getTemplate() 
	{
		foreach($this->getValues() as $subValues)
			$this->_template->setPropertiesFromArray($subValues);

		return $this->_template;
	}


	// ====================================================================
	//
	// 	Constructor
	//
	// ====================================================================
	
	
    public function  __construct($options = null) {
		parent::__construct($options);

		$tabOne = $this->createTabOne();
		$tabOne->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-settings', 'class'=>'tabs-content'))
		));

		$tabTwo = $this->createTabTwo();
		$tabTwo->setLegend("Text Settings");
		$tabTwo->setDecorators(array(
			'FormElements',
			'Fieldset',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-text', 'class'=>'tabs-content'))
		));

		$tabThree = $this->createTabThree();
		$tabThree->setLegend("HTML Settings");
		$tabThree->setDecorators(array(
			'FormElements',
			'Fieldset',
			array('HtmlTag',array('tag'=>'div', 'id'=>'tab-html', 'class'=>'tabs-content'))
		));


		$this->addSubForm($tabOne, 'settings');
		$this->addSubForm($tabTwo, 'text_form');
		$this->addSubForm($tabThree, 'html_form');

		$this->removeDecorator('Form');


		//$this->setDisableLoadDefaultDecorators(false);
	}

	private function createTabThree() {
		$form = new Zend_Form_SubForm();
		$form->addElement(
			$this->createElement('textarea', 'html_body')
				->setLabel("HTML Template")
				->setAttrib('class', 'full-width')
				->setAttrib('id', 'html_body')
				->setRequired()
		);

		return $form;
	}

	private function createTabTwo() {
		$form = new Zend_Form_SubForm();

		$form->addElement(new Skyseek_Form_Message('adminNotes', array(
			'message'		=> 'The text version is a bacnkup version to the HTML version, mostly older cell phones.',
			'messageType'	=> 'info',
			'showClose'		=> false
		)));

		$form->addElement(
			$this->createElement('textarea', 'text_body')
				->setLabel("Text Template")
				->setAttrib('class', 'full-width')
				->setAttrib('style', 'height:640px;')
				->setRequired()
		);

		return $form;
	}

	private function createTabOne() {
		$form = new Zend_Form_SubForm();

		$form->addElements(array(
			$this->createElement('text', 'subject')
				->setLabel('Email Subject')
				->setAttrib('class', 'full-width')
				->addValidator('StringLength', false,array(5,128))
				->setRequired(true),


			$this->createElement('text', 'from_email')
				->setLabel('From Email Address')
				->setAttrib('class', 'full-width')
				->addValidator('StringLength', false,array(5,256))
				->addValidator('EmailAddress')
				->setRequired(true),

			$this->createElement('text', 'from_alias')
				->setLabel('From Email Alias')
				->setAttrib('class', 'full-width')
				->addValidator('StringLength', false,array(5,128))
				->setRequired(true),

			$this->createElement('text', 'name')
				->setLabel('Template Name')
				->setAttrib('class', 'full-width')
				->addValidator('StringLength', false, array(3, 128))
				->setRequired(),

			$this->createElement('textarea', 'description')
				->setLabel('Template Description')
				->setAttrib('class', 'full-width')
				->addValidator('StringLength', false, array(3, 512))
				->setRequired(),

			new Skyseek_Form_Message('adminNotes', array(
				'message'		=> "These settings <strong>don't affect</strong> the emails sent out. They are only used for sanity's sake of keeping the templates organized.",
				'messageType'	=> 'info',
				'showClose'		=> 'true'
			))
		));

		$form->addDisplayGroup(
				array(
					'subject',
					'from_email',
					'from_alias'
				),
				'settings',
				array(
					'legend' => 'Email Settings'
		));

		$form->addDisplayGroup(
				array(
					'adminNotes',
					'name',
					'description'
				),
				'admin',
				array(
					'legend' => 'Admin Settings'
		));

		return $form;
	}
}
