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
 * Mapper
 *
 * @package    Skyseek
 * @subpackage SubPackage
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Email_Template_Mapper extends Skyseek_Model_Mapper {


	protected $_tableName = 'email_template';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_Email_Template_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_Email_Template_Collection
	 */
	public function getTemplateCollection(Skyseek_Model_Entity_Collection_Request $request=null) {
		$select = $this->_getGateway()->select();

		if($request) {
			$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
			$filterAdapter->applyRequest($select);
		}

		$collection = new GTW_Model_Email_Template_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createTemplateEntity($data, false));
		}

		return $collection;
	}

	public function getTemplate($id, $lazyLoad=true, $useIdentityMap=true) {
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentityMap($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createTemplateEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

		/**
	 * @return GTW_Model_Email_Template
	 */
	private function createTemplateEntity($data, $lazyLoad) {

		$entity = new GTW_Model_Email_Template(array(
			'id'			=> $data['id'],
			'name'			=> $data['name'],
			'description'	=> $data['description'],
			'subject'		=> $data['subject'],
			'text_body'		=> $data['text_body'],
			'html_body'		=> $data['html_body'],
			'from_alias'	=> $data['from_alias'],
			'from_email'	=> $data['from_email']
		));

		if (!$lazyLoad) {
			//Add lazy loader Calls
		}

		return $entity;
	}

	public function save(GTW_Model_Email_Template $template) {

		$validator = $this->getForm();

		if(!$validator->isValid($template->toArray()))
			throw new Exception("Invalid Data made it all the way down here... smh.");

		$data = array(
			'name'			=> $template->name,
			'description'	=> $template->description,
			'subject'		=> $template->subject,
			'text_body'		=> $template->text_body,
			'html_body'		=> $template->html_body,
			'from_alias'	=> $template->from_alias,
			'from_email'	=> $template->from_email
		);

		if($template->id == null) {
			$template->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, 'id=' . ((int)$template->id));
		}

		return $template;
	}

	public function getForm() {
		return new GTW_Model_Email_Template_Form();
	}
}
