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


class GTW_Model_User_Form extends Zend_Form {
    public function  __construct($options = null) {
		parent::__construct($options);

		$this->addElements(array(
			$this->createElement('text', 'first_name')
				->setLabel("First Name")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('text', 'last_name')
				->setLabel("Last Name")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('text', 'email')
				->setLabel("Email")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('select', 'status')
				->setLabel("Status")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('select', 'role')
				->setLabel("User Type")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('select', 'gender')
				->setLabel("Gender")
				->setAttrib('class', 'full-width')
				->setRequired(),

			$this->createElement('text', 'birth_date')
				->setLabel("Birth Date")
				->setAttrib('class', 'full-width')
				->setRequired()
		));
	}
}