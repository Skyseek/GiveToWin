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
 * Fundraiser Mapper
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Fundraiser_Mapper extends Skyseek_Model_Mapper 
{

	protected $_tableName = 'fundraiser';
	protected static $_instance;
	protected static $_identityMap = array();

	/**
	 * @return GTW_Model_Fundraiser_Mapper
	 */
	public static function getInstance() 
	{
		return parent::getInstance();
	}


	/**
	 * @return GTW_Model_Fundraiser_Collection
	 */
	public function getCollection(Skyseek_Model_Entity_Collection_Request $request) 
	{
		$select = $this->_getGateway()->select();

		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($request);
		$filterAdapter->applyRequest($select);

		$collection = new GTW_Model_Fundraiser_Collection();

		foreach ($select->query()->fetchAll() as $data) {
			$collection->addItem($this->createFundraiserEntity($data, false));
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
		$paginator->setFilter(new GTW_Model_Fundraiser_Collection());

		if($request !== null) {
			$paginatorRequestAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_Paginator($request);
			$paginatorRequestAdapter->applyRequest($paginator);
		}
		
		
		return $paginator;
	}

	public function getFundraiser($id, $lazyLoad=true, $useIdentityMap=true) 
	{
		if ($useIdentityMap && $this->hasIdentity($id)) {
			return $this->getIdentity($id);
		}


		$result = $this->_getGateway()->find($id)->current()->toArray();
		if (!$result) {
			return null;
		}


		$entity = $this->createFundraiserEntity($result, $lazyLoad);


		if ($useIdentityMap) {
			$this->setIdentity($id, $entity);
		}

		return $entity;
	}

	/**
	 * @return GTW_Model_Fundraiser
	 */
	private function createFundraiserEntity($data, $lazyLoad) 
	{

		$entity = new GTW_Model_Fundraiser(array(
			'id'			=> $data['id'],
			'title'			=> $data['title'],
			'description'	=> $data['description'],
			'cost'			=> $data['cost'],
			'goal'			=> $data['goal']
		));

		$entity->referenceId('status_id', $data['status_id']);
		$entity->referenceId('charity_id', $data['charity_id']);


		if (!$lazyLoad) {
			$entity->getStatus();
			$entity->getCharity();			
		}

		return $entity;
	}

	/**
	 *
	 * @param GTW_Model_Fundraiser $fundraiser
	 * 
	 * @return GTW_Model_Fundraiser
	 */
	public function save(GTW_Model_Fundraiser $fundraiser) 
	{
		$data = array(
			'title'			=> $fundraiser->title,
			'description'	=> $fundraiser->description,
			'cost'			=> $fundraiser->cost,
			'goal'			=> $fundraiser->goal,
			'charity_id'		=> $fundraiser->getCharity()->id,
			'status_id'		=> $fundraiser->getStatus()->id
		);

		if($fundraiser->id == null) {
			$fundraiser->id =  $this->_getGateway()->insert($data);
		} else {
			$this->_getGateway()->update($data, "id = {$fundraiser->id}");
		}

		return $fundraiser;
	}
}

