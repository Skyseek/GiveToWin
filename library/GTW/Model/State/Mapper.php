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
 * State Mapper
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_State_Mapper extends Skyseek_Model_Mapper 
{

	// ====================================================================
	//
	// 	Private Properties
	//
	// ====================================================================
	
	protected $_tableName = 'state';
	protected static $_identityMap = array();
	protected static $_instance;


	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	/**
	 * @return GTW_Model_State_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_State_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request = null) 
	{
		$select = $this->_getGateway()->select();

		if($request !== null) {
			$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
			$filterAdapter->applyRequest($select);
		}
		

		$collection = new GTW_Model_State_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createStateEntity($data, false));
		}

		return $collection;
	}


	/**
	 * @return Zend_Paginator
	 */
	public function getPaginator(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$paginator = Zend_Paginator::factory($select);
		$paginator->setFilter(new GTW_Model_City_Collection());
		
		return $paginator;
	}

	public function getState($id, $lazyLoad=true, $useIdentityMap=true) {
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createStateEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

		/**
	 * @return GTW_Model_State
	 */
	private function createStateEntity($data, $lazyLoad) {

		$entity = new GTW_Model_State($data);

		if (!$lazyLoad) {
			//Add lazy loader Calls
		}

		return $entity;
	}

}