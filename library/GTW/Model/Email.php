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
 * Email
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Email extends Skyseek_Model_Entity{
    protected $_mapper = "GTW_Model_Email_Mapper";

	public $id;
	public $subject;
	public $text_content;
	public $html_content;
	public $from_email;
	public $from_alias;
	public $to_email;
	public $to_alias;
	public $time_created;
	public $time_sent;


	protected $_user;
	protected $_userMapper;


	protected $_emailTemplate;
	protected $_emailTemplateMapper;

	/**
	 * @param GTW_Model_Email_Template $emailTemplate
	 */
	public function setEmailTemplate(GTW_Model_Email_Template $emailTemplate) {
		$this->_emailTemplate = $emailTemplate;
	}

	/**
	 * @return GTW_Model_Email_Template
	 */
	public function getEmailTemplate() {
		if ($this->_emailTemplate == null && $this->referenceId('emailTemplate_id')) {
			$this->_emailTemplate = $this->emailTemplateMapper()->find($this->referenceId('emailTemplate_id'));
		}

		return $this->_emailTemplate;
	}

	/**
	 * @param GTW_Model_User $user
	 */
	public function setUser(GTW_Model_User $user) {
		$this->_user = $user;
	}

	/**
	 * @return GTW_Model_User
	 */
	public function getUser() {
		if ($this->_user == null && $this->referenceId('user_id')) {
			$this->_user = $this->userMapper()->find($this->referenceId('user_id'));
		}

		return $this->_user;
	}

	/**
	 * @param GTW_Model_User_Mapper $userMapper
	 * @return GTW_Model_User_Mapper
	 */
	public function userMapper(GTW_Model_User_Mapper $userMapper=null) {
		if ($userMapper)
			$this->_userMapper = $userMapper;

		if ($this->_userMapper === null)
			$this->_userMapper = new GTW_Model_User_Mapper();

		return $this->_userMapper;
	}

	/**
	 * @param GTW_Model_Email_Template_Mapper $emailTemplateMapper
	 * @return GTW_Model_Email_Template_Mapper
	 */
	public function emailTemplateMapper(GTW_Model_Email_Template_Mapper $emailTemplateMapper=null) {
		if ($emailTemplateMapper)
			$this->_emailTemplateMapper = $emailTemplateMapper;

		if ($this->_emailTemplateMapper === null)
			$this->_emailTemplateMapper = new GTW_Model_Email_Template_Mapper();

		return $this->_emailTemplateMapper;
	}
}
