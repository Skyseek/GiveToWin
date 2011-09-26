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
class GTW_Model_City_Subscription_Mapper extends Skyseek_Model_Mapper {


	protected $_tableName	= 'city_subscription';
	protected $_primary		= array('id');

	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_City_Subscription_Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_City_Subscription_Collection
	 */
	public function getSubscriptionCollection(Skyseek_Model_Entity_Collection_Request $request) {
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_City_Subscription_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createSubscriptionEntity($data, false));
		}

		return $collection;
	}

	public function getSubscriptionByCityAndUser($city) {

	}

	public function getSubscription($id, $lazyLoad=true, $useIdentityMap=true) {

		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentityMap($id);
		}

		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createSubscriptionEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

	/**
	 * @return GTW_Model_City_Subscription
	 */
	private function createSubscriptionEntity($data, $lazyLoad) {

		$entity = new GTW_Model_City_Subscription($data);

		if (!$lazyLoad) {
			//Add lazy loader Calls
		}

		return $entity;
	}

	/**
	 *
	 * @param GTW_Model_City_Subscription $subscription'
	 *
	 * @return GTW_Model_City_Subscription
	 */
	public function save(GTW_Model_City_Subscription $subscription) {
		$data = array(
			'user_id'		=> $subscription->getUser()->id,
			'city_id'		=> $subscription->getCity()->id,
		);


		if($subscription->id === null) {
			$subscription->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, $this->getWhereSQL($subscription->id));
		}


		return $subscription;
	}

	public function delete(GTW_Model_City_Subscription $subscription) 
	{
		$this->_getGateway()->delete("id='{$subscription->id}'");
	}

}
