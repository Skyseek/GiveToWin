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
 * Description of Skyseek_Exception
 *
 * @package    Skyseek
 * @subpackage AMF
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_AMF_Rowset {

	public $data;
	public $pageCount;
	public $currentPage;
	public $itemsPerPage;
	public $itemCount;

	public function  __construct(Zend_Paginator $paginator=null, $voClass=false) {
		if($paginator) {
			$this->packPaginator($paginator, $voClass);
		}
	}

	public function packPaginator(Zend_Paginator $paginator, $voClass=false) {
		$pageInfo = $paginator->getPages();

		
		foreach($paginator as $value) {
			if($voClass)
				$this->data[] = new $voClass($value->toArray());
			else
				$this->data[] = $value->toArray();
		}

		$this->pageCount = $pageInfo->pageCount;
		$this->currentPage = $pageInfo->current;
		$this->itemsPerPage = $pageInfo->itemCountPerPage;
		$this->itemCount = $pageInfo->totalItemCount;
	}

	public function setVOClass($className) {
		$newData = array();

		foreach($this->data as $val) {
			$newData = new $className($val);
		}

		//$this->data = $newData;
	}

	public static function buildRowset(Zend_Db_Table_Abstract $table, Skyseek_AMF_Rowset_Request $request, $voClass=false, $orderBy=false) {
		//Apply Filters, Create Select Statment.

		if(count($request->filters))
			$selectStatement = $table->select()->where($request->getWhereStatement());
		else
			$selectStatement = $table->select();

		if($orderBy)
			$selectStatement->order ($orderBy);
		
		//Build Paginator from Select Statment
		$paginator = Zend_Paginator::factory($selectStatement);
		
		//Apply Page,PerPage to Paginator
		$request->setPaginatorParams($paginator);
		
		//Build Rowset Response
		$rowset = new Skyseek_AMF_Rowset($paginator, $voClass);

		//Return Rowset ;)
		return $rowset;
	}
}