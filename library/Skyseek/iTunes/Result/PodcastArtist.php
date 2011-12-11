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
 * @subpackage Results
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Skyseek_iTunes_Result_Artist
 *
 * @package    iTunes-API
 * @subpackage Results
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Result_PodcastArtist extends Skyseek_iTunes_Result {
	public $data;

	public $artistId;
	public $iTunesUrl;
    public $name;
	public $primaryGenreName;
	public $primaryGenreId;
	public $amgArtistId;
	public $amgVideoArtistId;

	/**
	 * Generates a standard iTunes Movie Object
	 *
	 * @param stdClass $data Object response from iTunes Search API
	 */
	public function  __construct(stdClass $data) {
		$this->data = $data;

		foreach($data as $property=>$value) {
			if(property_exists($this, $property)) {
				$this->$property = $value;
			} else {
				switch($property) {
					case 'artistName':
						$this->name = $value;
						break;
					case 'artistLinkUrl':
						$this->iTunesUrl = $value;
						break;
				}
			}
		}
	}
}