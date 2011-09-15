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
 * City Mapper
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_City_Mapper extends Skyseek_Model_Mapper 
{
	
	protected $_tableName = 'city';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_City_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}

	/**
	 * @return GTW_Model_City_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_City_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createCityEntity($data, false));
		}

		return $collection;
	}
	
	
	public function getPaginator(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$paginator = Zend_Paginator::factory($select);
		$paginator->setFilter(new GTW_Model_City_Collection());
		
		
		return $paginator;
	}

	public function getCities(Skyseek_Model_Entity_Collection_Request $request) {

		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_City_Collection();

		foreach($select->query()->fetchAll() as $cityData) {
			$collection->addItem($this->createCityEntity($cityData, false));
		}

		return $collection;
	}

	public function getCity($id, $lazyLoad=true, $useIdentityMap=true) {
		if($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}

		$result = $this->_getGateway()->find($id)->current()->toArray();
		if(!$result) {
			return null;
		}


		$entity = $this->createCityEntity($result, $lazyLoad);
		
		if($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}


	private function createCityEntity($data, $lazyLoad) {

		$city = new GTW_Model_City(array(
			'id'			=> $data['id'],
			'city'			=> $data['city']
		));

		$city->referenceId('state_id', $data['state_id']);
		$city->referenceId('status_id', $data['status_id']);

		if(!$lazyLoad) {
			$city->getState();
			$city->getStatus();
		}

		return $city;
	}

	/**
	 *
	 * @param GTW_Model_City $city
	 * 
	 * @return GTW_Model_City
	 */
	public function save(GTW_Model_City $city) 
	{
		$data = array(
			'city'		=> $city->city,
			'state_id'	=> $city->state->id,
			'status_id'	=> $city->status->id
		);

		if($city->id == null) {
			$city->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, "id = {$city->id}");
		}

		return $city;
	}
}
