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
 * @subpackage iTunes-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Abstract
 *
 * @package    iTunes-API
 * @subpackage iTunes-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
abstract class Skyseek_iTunes_API_Abstract {
    /**
	 * HTTP Endpoint for all service calls.
	 *
	 * @var String
	 */
	private $_api_url = "";

	/**
	 * The two-letter country code for the store you want to search.
	 * The search uses the default store front for the specified country.
	 * For example: US.
	 *
	 * @var String
	 */
	public $country = 'US';

	/**
	 * The number of search results you want the iTunes Store to return.
	 * For example: 25.
	 *
	 * @var int
	 */
	public $limit = 50;

	/**
	 * The result index at which to start returning results
	 *
	 * @var int
	 */
	public $offset;

	/**
	 * The language, English(en_us) or Japanese(ja_jp), you want to use when
	 * returning search results. Specify the language using the 5-letter codename.
	 * For example: en_us.
	 *
	 * @var string
	 */
	public $language = "en_us";

	/**
	 * A flag indicating whether or not you want to include explicit content
	 * in your search results.
	 *
	 * @var boolean
	 */
	public $explicit = true;
}
