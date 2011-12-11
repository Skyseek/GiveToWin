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
 * Result
 *
 * @package    iTunes-API
 * @subpackage Results
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Result {
	
	public static function factory($data) {
		if(is_array($data)) {
			$array = $data;
			$data = new stdClass();
			
			foreach($array as $key=>$value) {
				$data->$key = $value;
			}
		}

		if(property_exists($data, 'wrapperType')) {

			if(property_exists($data, 'artistType')) {
				switch($data->artistType) {
					case 'Artist':
						return new Skyseek_iTunes_Result_Artist($data);
					case 'Movie Artist':
						return new Skyseek_iTunes_Result_Actor($data);
					case 'Podcast Artist':
						return new Skyseek_iTunes_Result_PodcastArtist($data);
				}
			}

			if(property_exists($data, 'collectionType')) {
				switch($data->collectionType) {
					case 'Album':
					case 'Compilation':
					case 'MaxiSingle':
						return new Skyseek_iTunes_Result_Album($data);
				}
			}

		}



		
		if(property_exists($data, 'kind')) {
			switch($data->kind) {
				case 'album':
					break;
				case 'book':
					break;
				case 'feature-movie':
					return new Skyseek_iTunes_Result_Movie($data);
				case 'song':
					return new Skyseek_iTunes_Result_Song($data);
				case 'podcast':
					return new Skyseek_iTunes_Result_Podcast($data);
			}
		}



		echo "Unknown Data Type:";
		print_r($data);
		exit;
	}
}
