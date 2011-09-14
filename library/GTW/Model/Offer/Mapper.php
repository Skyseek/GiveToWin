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
 * Offer Mapper
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Offer_Mapper extends Skyseek_Model_Mapper 
{

	protected $_tableName = 'offer';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_Offer_Mapper
	 */
	public static function getInstance() 
	{
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_Offer_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_Offer_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createOfferEntity($data, false));
		}

		return $collection;
	}
	
	
	public function getPaginator(Skyseek_Model_Entity_Collection_Request $request = null) 
	{
		$select = $this->_getGateway()->select();

		if($request !== null) {
			$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
			$filterAdapter->applyRequest($select);	
		}

		$paginator = Zend_Paginator::factory($select);
		$paginator->setFilter(new GTW_Model_Offer_Collection());

		if($request !== null) {
			$paginatorRequestAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_Paginator($request);
			$paginatorRequestAdapter->applyRequest($paginator);
		}
		
		
		return $paginator;
	}

	public function getOffer($id, $lazyLoad=true, $useIdentityMap=true) 
	{
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createOfferEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

	/**
	 * @return GTW_Model_Offer
	 */
	private function createOfferEntity($data, $lazyLoad) 
	{

		$entity = new GTW_Model_Offer(array(
			'id'			=> $data['id'],
			'title'			=> $data['title'],
			'description'	=> $data['description'],
			'value'			=> $data['value'],
			'minimum'		=> $data['minimum'],
			'fine_print'	=> $data['fine_print'],
			'highlights'	=> $data['highlights']
		));

		$entity->referenceId('status_id', $data['status_id']);
		$entity->referenceId('company_id', $data['company_id']);


		if (!$lazyLoad) {
			$entity->getStatus();
			$entity->getCompany();			
		}

		return $entity;
	}

	/**
	 *
	 * @param GTW_Model_Offer $offer
	 * 
	 * @return GTW_Model_Offer
	 */
	public function save(GTW_Model_Offer $offer) 
	{
		$data = array(
			'title'			=> $offer->title,
			'description'	=> $offer->description,
			'value'			=> $offer->value,
			'minimum'		=> $offer->minimum,
			'fine_print'	=> $offer->fine_print,
			'highlights'	=> $offer->highlights,
			'company_id'	=> $offer->getCompany()->id,
			'status_id'		=> $offer->getStatus()->id
		);

		if($offer->id == null) {
			$offer->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, "id = {$offer->id}");
		}

		return $offer;
	}
}

