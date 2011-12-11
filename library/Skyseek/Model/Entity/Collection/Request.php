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
 * @subpackage Model
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Request
 *
 * @package    Skyseek
 * @subpackage Model
 * @copyright  Copyright (c) 2011, Skyseek.com
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Model_Entity_Collection_Request {
    protected $_pageNumber;
	protected $_perPage;
	protected $_filters = array();
	protected $_orderBy;

	public function __construct($pageNumber=1, $perPage=25) {
		$this->setPageNumber($pageNumber);
		$this->setPerPage($perPage);
	}

	public function setPerPage($perPage) {
		if(!is_int($perPage))
			throw new Exception("Invalid per page value. Only integers are allowed.");

		$this->_perPage = $perPage;
	}

	public function getPerPage() {
		return $this->_perPage;
	}

	public function setPageNumber($pageNumber) {
		$pageNumber = (int) $pageNumber;

		if($pageNumber < 1)
			throw new Exception("Invalid page number. Only integers are allowed.");

		$this->_pageNumber = $pageNumber;
	}

	public function getPageNumber() {
		return $this->_pageNumber;
	}

	public function setOrderBy($orderBy) {
		if(!is_string($orderBy) && !is_array($orderBy))
			throw new Exception("Invalid order by. Only strings||arrays are allowed.");

		$this->_orderBy = $orderBy;
	}

	public function getOrderBy() {
		return $this->_orderBy;
	}

	public function addFilter($filter, $filterType='contains', $filterValue='') {
		if($filter instanceof Skyseek_Model_Entity_Collection_Request_Filter)
			$this->_filters[] = $filter;
		else if(is_string($filter) || is_array($filter))
			$this->_filters[] = new Skyseek_Model_Entity_Collection_Request_Filter($filter, $filterValue, $filterType);
		else
			throw new Exception("Invalid Filter added");
	}

	public function getFilters() {
		return $this->_filters;
	}
}
