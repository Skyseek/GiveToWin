<?php
/** 
 * Skyseek License, Version 1.0
 * 
 * This file contains Original Code and/or Modifications of Original Code
 * as defined in and that are subject to the Skyseek License
 * Version 1.0 (the 'License'). You may not use this file except in
 * compliance with the License. Please obtain a copy of the License at
 * http://www.skyseek.com/License/Version1 and read it before using this
 * file.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Skyseek
 * @subpackage Paginator
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * DB
 *
 * @package    Skyseek
 * @subpackage Paginator
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Paginator_Adapter_Db extends Zend_Paginator_Adapter_DbSelect {

	protected $_itemClass;
	protected $_collectionClass;

	/**
	 *
	 * @var Skyseek_Entity_Collection_Request
	 */
	protected $_request;


	public function __construct(Zend_Db_Select $select, $itemClass=null, $collectionClass=null) {
		parent::__construct($select);

		$this->setItemClass($itemClass);
		$this->setCollectionClass($collectionClass);
	}

	public function setItemClass($itemClass) {
		$this->_itemClass = $itemClass;

		return $this;
	}

	public function setCollectionClass($collectionClass) {
		$this->_collectionClass = $collectionClass;

		return $this;
	}

	public function setRequest(Skyseek_Model_Entity_Collection_Request $request) {
		$this->_request = $request;

		return $this;
	}

	/**
	 *
	 * @return Skyseek_Entity_Collection_Request
	 */
	public function getRequest() {
		return $this->_request;
	}

	/**
     * Returns an array of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
		$filterAdapter = new Skyseek_Model_Entity_Collection_Request_Adapter_DbSelect($this->_request);
		$filterAdapter->applyRequest($this->_select);

		$rows = parent::getItems($offset, $itemCountPerPage);

		if($this->_itemClass) {
			$items = array();

			foreach($rows as $row)
				$items[] = new $this->_itemClass($row);

			if($this->_collectionClass)
				return new $this->_collectionClass($items);
			else
				return $items;
		} else {
			return $rows;
		}
    }
}
