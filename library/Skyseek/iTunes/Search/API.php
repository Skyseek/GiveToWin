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
 * @subpackage Search-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */

require_once('Exception.php');


/**
 * Skyseek iTunes Search API
 *
 * The Search API allows you to place search fields in your website to search
 * for content within the iTunes Store, App Store, iBookstore and Mac App Store.
 * You can search for a variety of content; including apps, ebooks, movies,
 * podcasts, music, music videos, audiobooks, and TV shows. You can also call
 * an ID-based lookup request to create mappings between your content library
 * and the digital catalog.
 *
 *
 * @package    iTunes-API
 * @subpackage Search-API
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Search_API extends Skyseek_iTunes_API_Abstract {

	/**
	 * HTTP Endpoint for all service calls.
	 *
	 * @var String
	 */
	private $_api_url = "http://itunes.apple.com/search";

	/**
	 * Search for movies.
	 *
	 * Valid Search Property Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_PropertyType::ALL</li>
	 *     <li>Skyseek_iTunes_PropertyType::ARTIST</li>
	 *     <li>Skyseek_iTunes_PropertyType::DESCRIPTION</li>
	 *     <li>Skyseek_iTunes_PropertyType::DIRECTOR</li>
	 *     <li>Skyseek_iTunes_PropertyType::FEATURE_FILM</li>
	 *     <li>Skyseek_iTunes_PropertyType::GENRE_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::MOVIE</li>
	 *     <li>Skyseek_iTunes_PropertyType::MOVIE_ARTIST</li>
	 *     <li>Skyseek_iTunes_PropertyType::PRODUCER</li>
	 *     <li>Skyseek_iTunes_PropertyType::RATING</li>
	 *     <li>Skyseek_iTunes_PropertyType::RATING_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::RELEASE_YEAR</li>
	 *     <li>Skyseek_iTunes_PropertyType::SHORT_FILM</li>
	 *  </ul>
	 *
	 *
	 * Valid Search Entity Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_EntityType::MOVIE</li>
	 *     <li>Skyseek_iTunes_EntityType::MOVIE_ARTIST</li>
	 *
	 *  </ul>
	 *
	 *
	 * <b>Example #1: Search For Matrix Movies</b>
	 * <code>
	 *      $searchAPI = new Skyseek_iTunes_Search_API();
	 *      $results = $searchAPI->searchMovies('Matrix');
	 *
	 *      foreach($results as $result) {
	 *           echo "{$result->title} was released in {$result->releaseDate}.<br />";
	 *      }
	 * </code>
	 *
	 * <b>Example #2: Search For Matrix Movies, Sort & Then Display.</b>
	 * <code>
	 * $searchAPI = new Skyseek_iTunes_Search_API();
	 * $results = $searchAPI->searchMovies('Matrix', Skyseek_iTunes_PropertyType::MOVIE);
	 * $results->sort('releaseDate');
	 *
	 * foreach ($results as $result) {
	 *     echo "<img src='{$result->artworkUrl200}' /><br />";
	 *     echo "<h3>{$result->name} (\${$result->price})</h3>";
	 *     echo "<b>Released:</b> " . $result->getReleaseDateFormatted('F d, Y') . "<br />";
	 *     echo "<b>Length:</b> " . $result->getLengthFormatted('%h hour and %m minutes') . "<br /><br />";
	 *     echo "{$result->description}<br /><br />";
	 *     echo "<a href='{$result->iTunesUrl}'>Open in Itunes &gt;&gt;</a><br /><br /><hr/><br />";
	 * }
	 *
	 * </code>
	 * 
	 * <b>Example #3: Search For Matrix Movie Actors, Directors</b>
	 * <code>
	 * $searchAPI = new Skyseek_iTunes_Search_API();
	 * $results = $searchAPI->searchMovies('Matrix', Skyseek_iTunes_PropertyType::MOVIE, Skyseek_iTunes_EntityType::MOVIE_ARTIST);
	 *
	 * foreach ($results as $result) {
	 *     echo "<a href='{$result->iTunesUrl}'>{$result->name} &gt;&gt;</a><br />";
	 * }
	 * </code>
	 *
	 *
	 * @param string $term Text to search for
	 * @param string $propertyType Type of property to search
	 * @param string $entityType Type of entity to return.
	 *
	 * @return Skyseek_iTunes_Search_API_Resultset Resultset object containing results.
	 */
	public function searchMovies($term, $propertyType=Skyseek_iTunes_PropertyType::ALL, $entityType=Skyseek_iTunes_EntityType::MOVIE) {

		//Possible Search Properties
		$validSearchProperties = array(
			Skyseek_iTunes_PropertyType::ALL,
			Skyseek_iTunes_PropertyType::ARTIST,
			Skyseek_iTunes_PropertyType::DESCRIPTION,
			Skyseek_iTunes_PropertyType::DIRECTOR,
			Skyseek_iTunes_PropertyType::FEATURE_FILM,
			Skyseek_iTunes_PropertyType::GENRE_INDEX,
			Skyseek_iTunes_PropertyType::MOVIE,
			Skyseek_iTunes_PropertyType::MOVIE_ARTIST,
			Skyseek_iTunes_PropertyType::PRODUCER,
			Skyseek_iTunes_PropertyType::RATING,
			Skyseek_iTunes_PropertyType::RATING_INDEX,
			Skyseek_iTunes_PropertyType::RELEASE_YEAR,
			Skyseek_iTunes_PropertyType::SHORT_FILM
		);
		
		//Possible Entity Types
		$validEntityTypes = array(
			Skyseek_iTunes_EntityType::MOVIE,
			Skyseek_iTunes_EntityType::MOVIE_ARTIST
		);


		if(!in_array($propertyType, $validSearchProperties))
			throw new Skyseek_iTunes_Search_Exception("Invalid search property '$propertyType' specified");


		if(!in_array($entityType, $validEntityTypes))
			throw new Skyseek_iTunes_Search_Exception("Invalid entity type '$entityType' specified");


		return $this->search($term, 'movie', $propertyType, $entityType);
	}


	/**
	 * Search for podcasts.
	 *
	 * Valid Search Property Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_PropertyType::ALL</li>
	 *     <li>Skyseek_iTunes_PropertyType::ARTIST</li>
	 *     <li>Skyseek_iTunes_PropertyType::DESCRIPTION</li>
	 *     <li>Skyseek_iTunes_PropertyType::GENRE_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::KEYWORDS</li>
	 *     <li>Skyseek_iTunes_PropertyType::LANGUAGE</li>
	 *     <li>Skyseek_iTunes_PropertyType::RATING_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::TITLE</li>
	 *  </ul>
	 *
	 *
	 * Valid Search Entity Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_EntityType::PODCAST</li>
	 *     <li>Skyseek_iTunes_EntityType::PODCAST_AUTHOR</li>
	 * </ul>
	 *
	 * <b>Example</b>
	 *
	 * <code>
	 * $searchAPI = new Skyseek_iTunes_Search_API();
	 * $results = $searchAPI->searchPodcasts('diggnation', Skyseek_iTunes_PropertyType::TITLE, Skyseek_iTunes_EntityType::PODCAST);
	 *
	 * foreach($results as $result) {
	 *     echo "<img src='{$result->artworkUrl200}'/>";
	 *     echo "<h1>{$result->name}</h1>";
	 *     echo "<a href='{$result->iTunesUrl}'>Open in iTunes</a><br /><br />";
	 * }
	 * </code>
	 *
	 * @param string $term Text to search for
	 * @param string $propertyType Type of property to search
	 * @param string $entityType Type of entity to return.
	 *
	 * @return Skyseek_iTunes_Search_API_Resultset Resultset object containing results.
	 */
	public function searchPodcasts($term, $propertyType=Skyseek_iTunes_PropertyType::ALL, $entityType=Skyseek_iTunes_EntityType::PODCAST) {

		//Possible Search Properties
		$validSearchProperties = array(
			Skyseek_iTunes_PropertyType::ALL,
			Skyseek_iTunes_PropertyType::ARTIST,
			Skyseek_iTunes_PropertyType::DESCRIPTION,
			Skyseek_iTunes_PropertyType::GENRE_INDEX,
			Skyseek_iTunes_PropertyType::KEYWORDS,
			Skyseek_iTunes_PropertyType::LANGUAGE,
			Skyseek_iTunes_PropertyType::RATING_INDEX,
			Skyseek_iTunes_PropertyType::TITLE
		);

		//Possible Entity Types
		$validEntityTypes = array(
			Skyseek_iTunes_EntityType::PODCAST,
			Skyseek_iTunes_EntityType::PODCAST_AUTHOR
		);

		if(!in_array($propertyType, $validSearchProperties))
			throw new Skyseek_iTunes_Search_Exception("Invalid search property '$propertyType' specified");


		if(!in_array($entityType, $validEntityTypes))
			throw new Skyseek_iTunes_Search_Exception("Invalid entity type '$entityType' specified");


		return $this->search($term, 'podcast', $propertyType, $entityType);
	}




	/**
	 * Search for movies.
	 *
	 * Valid Search Property Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_PropertyType::ALL</li>
	 *     <li>Skyseek_iTunes_PropertyType::ALBUM</li>
	 *     <li>Skyseek_iTunes_PropertyType::ARTIST</li>
	 *     <li>Skyseek_iTunes_PropertyType::COMPOSER</li>
	 *     <li>Skyseek_iTunes_PropertyType::GENRE_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::MIX</li>
	 *     <li>Skyseek_iTunes_PropertyType::MUSIC_TRACK</li>
	 *     <li>Skyseek_iTunes_PropertyType::RATING_INDEX</li>
	 *     <li>Skyseek_iTunes_PropertyType::SONG</li>
	 *  </ul>
	 *
	 *
	 * Valid Search Entity Types:
	 *
	 * <ul>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_ALBUM</li>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_ARTIST</li>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_MIX</li>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_SONG</li>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_TRACK</li>
	 *     <li>Skyseek_iTunes_EntityType::MUSIC_VIDEO</li>
	 * </ul>
	 *
	 *
	 * @param string $term Text to search for
	 * @param string $propertyType Type of property to search
	 * @param string $entityType Type of entity to return.
	 *
	 * @return Skyseek_iTunes_Search_API_Resultset Resultset object containing results.
	 */
	public function searchMusic($term, $propertyType=Skyseek_iTunes_PropertyType::ALL, $entityType=Skyseek_iTunes_EntityType::MUSIC_TRACK) {

		//Possible Search Properties
		$validSearchProperties = array(
			Skyseek_iTunes_PropertyType::ALBUM,
			Skyseek_iTunes_PropertyType::ALL,
			Skyseek_iTunes_PropertyType::ARTIST,
			Skyseek_iTunes_PropertyType::COMPOSER,
			Skyseek_iTunes_PropertyType::GENRE_INDEX,
			Skyseek_iTunes_PropertyType::MIX,
			Skyseek_iTunes_PropertyType::MUSIC_TRACK,
			Skyseek_iTunes_PropertyType::RATING_INDEX,
			Skyseek_iTunes_PropertyType::SONG
		);

		//Possible Entity Types
		$validEntityTypes = array(
			Skyseek_iTunes_EntityType::MUSIC_ALBUM,
			Skyseek_iTunes_EntityType::MUSIC_ARTIST,
			Skyseek_iTunes_EntityType::MUSIC_MIX,
			Skyseek_iTunes_EntityType::MUSIC_SONG,
			Skyseek_iTunes_EntityType::MUSIC_TRACK,
			Skyseek_iTunes_EntityType::MUSIC_VIDEO
		);

		if(!in_array($propertyType, $validSearchProperties))
			throw new Skyseek_iTunes_Search_Exception("Invalid search property '$propertyType' specified");


		if(!in_array($entityType, $validEntityTypes))
			throw new Skyseek_iTunes_Search_Exception("Invalid entity type '$entityType' specified");

		return $this->search($term, 'music', $propertyType, $entityType);
	}

	private function search($searchTerm, $searchMedia, $searchProperty, $searchEntityType) {
		$params = array(
			'term'=>$searchTerm,
			'country'=>$this->country,
			'media'=>$searchMedia,
			'entity'=>$searchEntityType,
			'limit'=>$this->limit,
			'lang'=>$this->language,
			'explicit'=>$this->explicit ? 'Yes' : 'No'
		);

		if($searchProperty != Skyseek_iTunes_PropertyType::ALL)
			$params['attribute'] = $searchProperty;

		$requestURL = $this->_api_url . '?' . http_build_query($params);


		$response = file_get_contents($requestURL);

		if(!$response)
			throw new Skyseek_iTunes_Search_Exception("Unable to connect to iTunes");

		$response = json_decode($response);

		//print_r($response);exit;

		if(empty($response))
			throw new Skyseek_iTunes_Search_Exception("Can't decode JSON. Invalid iTunes response.");
		
		//print_r($response);exit;

		$resultSet = new Skyseek_iTunes_Result_Set();

		foreach($response->results as $result)
			$resultSet->addResult(Skyseek_iTunes_Result::factory($result));
		
		return $resultSet;
	}

}
