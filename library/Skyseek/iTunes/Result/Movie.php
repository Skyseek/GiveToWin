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
class Skyseek_iTunes_Result_Movie extends Skyseek_iTunes_Result {

	public $trackId;
	
	public $name;
	public $censoredName;
	public $director;
	public $length;
	public $price;
	public $iTunesUrl;
	public $explicityType;
	public $releaseDate;
	public $country;
	public $currency;
	public $primaryGenreName;
	public $contentAdvisoryRating;
	public $description;
	public $previewUrl;
	public $data;
	
	/**
	 * A URL for the artwork associated with the returned media type, sized to 30x30 pixels.
	 *
	 * @var String
	 */
	public $artworkUrl30;

	/**
	 * A URL for the artwork associated with the returned media type, sized to 60x60 pixels.
	 *
	 * @var String
	 */
	public $artworkUrl60;

	/**
	 * A URL for the artwork associated with the returned media type, sized to 100x100.
	 *
	 * @var String
	 */
	public $artworkUrl100;


	/**
	 * A URL for the artwork associated with the returned media type, sized to 200x200.
	 *
	 * @var String
	 */
	public $artworkUrl200;


	/**
	 * A URL for the artwork associated with the returned media type, sized to 227x227.
	 *
	 * @var String
	 */
	public $artworkUrl227;

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
					case 'trackName':
						$this->name = $value;
						break;
					case 'trackExplicitness':
						$this->explicityType = $value;
						break;
					case 'trackPrice':
						$this->price = $value;
						break;
					case 'trackTimeMillis':
						$this->length = $value;
						break;
					case 'trackViewUrl':
						$this->iTunesUrl = $value;
						break;
					case 'trackCensoredName':
						$this->censoredName = $value;
						break;
					case 'artistName':
						$this->director = $value;
						break;
					case 'longDescription':
						$this->description = $value;
						break;
					default:
						//echo $property . " / ";

				}
			}

			if($data->artworkUrl100) {
					$data->artworkUrl200 = str_replace ('100x100', '200x200', $data->artworkUrl100);
					$data->artworkUrl227 = str_replace ('100x100', '227x227', $data->artworkUrl100);
			}
		}
	}

	/**
	 * Format the movie length.
	 *
	 * <b>The following characters are recognized in the format parameter string</b>
	 *
	 * <ul>
	 *     <li>%h - Hours </li>
	 *     <li>%m - Minutes (to be used with the %h character) </li>
	 *     <li>%s - Seconds (to be used with the %h/%m characters) </li>
	 *     <li>%M - Total Minutes </li>
	 *     <li>%S - Total Seconds</li>
	 * </ul>
	 *
	 *
	 * <b>Examples</b>
	 *
	 * <code>
	 *     echo $movie->getLengthFormatted('Movie is %h hours, %m minutes, and %s seconds long');
	 *     //Will echo "Movie is 2 hours, 13 minutes, and 29 seconds long"
	 *
	 *     echo $movie->getLengthFormatted('Movie is %M minutes long');
	 *     //Will echo "Movie is 133 minutes long"
	 *
	 *     echo $movie->getLengthFormatted('Movie is %S');
	 *     //Will echo "Movie is 8009 seconds long"
	 *
	 * </code>
	 *
	 * @param String $format The format of the outputted date string. See the formatting options below.
	 *
	 * @return string formatted movie length
	 */
	public function getLengthFormatted($format="%M minutes") {
		$hours = floor($this->length / 3600000);
		$minutes = floor(($this->length % 3600000) / 60000);
		$seconds = floor((($this->length % 3600000) % 60000) / 1000);
		$totalMinutes = ceil($this->length / 60000);
		$totalSeconds = ceil($this->length / 1000);
		
		$formatCharacters = array('%s', '%m', '%h', '%M', '%S');
		$formatValues = array($seconds, $minutes, $hours, $totalMinutes, $totalSeconds);

		return str_replace($formatCharacters, $formatValues, $format);
	}

	public function getReleaseDateFormatted($format="c") {
		$time = strtotime($this->releaseDate);
		return date($format, $time);
	}
}
