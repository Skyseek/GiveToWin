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
 * @package    iTunes-API
 * @subpackage Lookup-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Lookup API
 *
 * @package    iTunes-API
 * @subpackage Lookup-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Lookup_API extends Skyseek_iTunes_API_Abstract {

	/**
	 * HTTP Endpoint for all lookup service calls.
	 *
	 * @var String
	 */
	private $_api_url = "http://itunes.apple.com/lookup";

	
	/**
	 * Lookup by All Music Guide(AMG) Artist ID
	 * 
	 * @param mixed $amgArtistId All Music Guide (AMG) ID
	 * @param String $entityType Entity Type
	 * 
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getByAmgArtistId($amgArtistId, $entityType=null) {
		return $this->lookup('amgArtistId', (int) $amgArtistId, $entityType);
	}

	/**
	 * Lookup by All Music Guide(AMG) Album ID
	 *
	 * @param int $amgAlbumId All Music Guide(AMG) Album ID
	 * @param string $entityType Entity Type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getByAmgAlbumId($amgAlbumId, $entityType=null) {
		return $this->lookup('amgAlbumId', (int) $amgArtistId, $entityType);
	}

	/**
	 * Lookup by UPC Code
	 *
	 * @param string $upc UPC Code
	 * @param string $entityType Entity Type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getByUpc($upc, $entityType=null) {
		return $this->lookup('upc', $id, $entityType);
	}

	/**
	 * Lookup by 13 digit ISBN Number
	 *
	 * @param <type> $isbn 13 digit ISBN Number
	 * @param <type> $entityType Entity Type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getByIsbn($isbn, $entityType=null) {
		return $this->lookup('isbn', $id, $entityType);
	}

	/**
	 * Lookup ByiTunes IDs
	 *
	 * @param int $id iTunes IDs
	 * @param string $entityType Entity Type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getById($id, $entityType=null) {
		return $this->lookup('id', (int) $id, $entityType);
	}

	/**
	 * Calls lookup call to iTunes API
	 *
	 * @param string $searchKey
	 * @param string $searchValue
	 * @param string $entityType Entity Type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	private function lookup($searchKey, $searchValue, $entityType=null) {

		$params = array(
			$searchKey=>$searchValue,
			'country'=>$this->country,
			'limit'=>$this->limit,
			'lang'=>$this->language,
			'explicit'=>$this->explicit ? 'Yes' : 'No'
		);

		if($entityType)
			$params['entity'] = $entityType;

		$requestURL = $this->_api_url . '?' . http_build_query($params);
		//echo $requestURL;

		$response = file_get_contents($requestURL);
		$response = json_decode($response);

		//print_r($response);exit;

		$resultSet = new Skyseek_iTunes_Result_Set();

		foreach($response->results as $result)
			$resultSet->addResult(Skyseek_iTunes_Result::factory($result));

		return $resultSet;
	}
}
