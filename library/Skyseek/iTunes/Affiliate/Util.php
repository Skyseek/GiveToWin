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
 * @subpackage Utilities
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */


/**
 * iTunes Affilate Network Utility
 *
 * @package    iTunes-API
 * @subpackage Utilities
 * @version    1.0
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Affiliate_Util {

	private $affilateURL;

	/**
	 * Generates the standard iTunes Affilate object
	 *
	 * @param string $linkSynergyURL Your LinkSynergy Affiliate URL
	 */
	public function  __construct($linkSynergyURL) {
		$this->affilateURL = $linkSynergyURL;
	}

	/**
	 * Converts a generic iTunes URL to an Affilated Link URL
	 * 
	 * <b>Example:</b>
	 *
	 * <code>
	 * $searchAPI = new Skyseek_iTunes_Search_API();
	 * $searchResults = $searchAPI->searchMusic('Rolling Stones');
	 *
	 * $linkSynergyURL = 'http://click.linksynergy.com/fs-bin/stat?id=Je3s7qkVWfQ&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=';
	 * $itunesAffiliate = new Skyseek_iTunes_Affiliate($linkSynergyURL);
	 *
	 * foreach($searchResults as $searchResult) {
	 *     $affiliateLink = $itunesAffiliate->createAffilateLink($searchResults);
	 *     echo "<a href='$affiliateLink'>{$searchResult->track_name}</a><br />";
	 * }
	 * </code>
	 *
	 * @param  string $itunesLink iTunes URL given from Search API
	 * @return string Affiliate Link URL
	 */
	public function createAffiliateLink($itunesLink) {
		$itunesLink .= (strpos($itunesLink, '?') ? '&' : '?');
		$itunesLink .= 'partnerId=30';
		$itunesLink = urlencode(urlencode($itunesLink));
		$itunesLink = $this->affilateURL . $itunesLink;

		return $itunesLink;
	}
}


