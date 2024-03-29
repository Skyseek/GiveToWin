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
class GTW_Model_City_Status_Mapper extends Skyseek_Model_Mapper {


	protected $_tableName = 'city_status';
	protected static $_identityMap = array();
	protected static $_instance;

	/**
	 * @return GTW_Model_City_Status_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_City_Status_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request = null) {
		$select = $this->_getGateway()->select();

		if($request !== null) {
			$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
			$filterAdapter->applyRequest($select);
		}

		$collection = new GTW_Model_City_Status_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createStatusEntity($data, false));
		}

		return $collection;
	}

	public function getStatus($id, $lazyLoad=true, $useIdentityMap=true) {
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createStatusEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

		/**
	 * @return GTW_Model_City_Status
	 */
	private function createStatusEntity($data, $lazyLoad) {

		$entity = new GTW_Model_City_Status($data);

		if (!$lazyLoad) {
			//Add lazy loader Calls
		}

		return $entity;
	}

}