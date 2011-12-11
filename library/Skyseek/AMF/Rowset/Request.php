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
 * @subpackage AMF
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

/**
 * Description of Skyseek_AMF_Rowset_Request
 *
 * @package    Skyseek
 * @subpackage AMF
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_AMF_Rowset_Request {
	public $page;
	public $perPage;
	public $filters = array();
	public $orderBy;

	public function getWhereStatement() {
		$query = implode(' AND ', $this->filters);

		return $query;
	}

	public function addFilter(Skyseek_AMF_Rowset_Filter $filter) {
		$this->filters[] = $filter;
	}

	public function setPaginatorParams(Zend_Paginator $paginator) {
		
		$paginator->setCurrentPageNumber($this->page);
		$paginator->setItemCountPerPage($this->perPage);
	}
}