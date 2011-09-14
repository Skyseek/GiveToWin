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
 * User Mapper
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_User_Mapper extends Skyseek_Model_Mapper 
{

	protected $_tableName = 'user';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_User_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_User_Collection
	 */
	public function getUserCollection(Skyseek_Model_Entity_Collection_Request $request) {
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_User_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createUserEntity($data, false));
		}

		return $collection;
	}
	
	
	public function getPaginator(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$paginator = Zend_Paginator::factory($select);
		$paginator->setFilter(new GTW_Model_User_Collection());
		
		
		return $paginator;
	}

	public function getUser($id, $lazyLoad=true, $useIdentityMap=true) {
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createUserEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

		/**
	 * @return GTW_Model_User
	 */
	private function createUserEntity($data, $lazyLoad) {

		$entity = new GTW_Model_User(array(
			'id'			=> $data['id'],
			'first_name'	=> $data['first_name'],
			'last_name'		=> $data['last_name'],
			'email'			=> $data['email'],
			'password'		=> $data['password'],
			'gender'		=> $data['gender']
		));

		$entity->referenceId('status_id', $data['status_id']);
		$entity->referenceId('role_id', $data['role_id']);

		if (!$lazyLoad) {
			$entity->getStatus();
		}

		return $entity;
	}

	/**
	 *
	 * @param GTW_Model_User $user'
	 * 
	 * @return GTW_Model_User
	 */
	public function save(GTW_Model_User $user) {
		$data = array(
			'email'			=> $user->email,
			'first_name'	=> $user->first_name,
			'last_name'		=> $user->last_name,
			'password'		=> $user->password,
			'status_id'		=> $user->getStatus()->id,
			'role_id'		=> $user->getRole()->id
		);

		if($user->id == null) {
			$user->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, "id='{$user->id}'");
		}

		return $user;
	}
}

