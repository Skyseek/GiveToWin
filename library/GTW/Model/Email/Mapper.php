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
class GTW_Model_Email_Mapper extends Skyseek_Model_Mapper {


	protected $_tableName = 'email';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_Email_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_Email_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request) {
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_Email_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createEmailEntity($data, false));
		}

		return $collection;
	}

	public function getEmail($id, $lazyLoad=true, $useIdentityMap=true) {
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentityMap($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createEmailEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

		/**
	 * @return GTW_Model_Email
	 */
	private function createEmailEntity($data, $lazyLoad) {

		$entity = new GTW_Model_Email(array(
			'id'			=> $data['id'],
			'subject'		=> $data['subject'],
			'text_content'	=> $data['text_content'],
			'html_content'	=> $data['html_content'],
			'to_email'		=> $data['to_email'],
			'to_alias'		=> $data['to_alias'],
			'from_email'	=> $data['from_email'],
			'from_alias'	=> $data['from_alias'],
			'time_created'	=> $data['time_created'],
			'time_sent'		=> $data['time_sent']
		));

		$entity->referenceId('user_id', $data['user_id']);
		$entity->referenceId('email_template_id', $data['email_template_id']);

		if (!$lazyLoad) {
			$entity->getUser();
			$entity->getEmailTemplate();
		}

		return $entity;
	}

	/**
	 *
	 * @param GTW_Model_Email $email
	 * 
	 * @return GTW_Model_Email
	 */
	public function save(GTW_Model_Email $email) 
	{
		$data = array(
			'subject'			=> $email->subject,
			'text_content'		=> $email->text_content,
			'html_content'		=> $email->html_content,
			'to_email'			=> $email->to_email,
			'to_alias'			=> $email->to_alias,
			'from_email'		=> $email->from_email,
			'from_alias'		=> $email->from_alias,
			'time_created'		=> $email->time_created,
			'time_sent'			=> $email->time_sent
		);

		if($email->getUser()) {
			$data['user_id'] = $email->user->id;
		}

		if($email->getEmailTemplate()) {
			$data['email_template_id'] = $email->emailTemplate->id;
		}

		if($email->id == null) {
			$email->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, "id = {$email->id}");
		}

		return $email;
	}
}
