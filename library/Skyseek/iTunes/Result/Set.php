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
 * Skyseek_iTunes_Result_Set
 *
 * @package    iTunes-API
 * @subpackage Results
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_Result_Set implements SeekableIterator, Countable {

	private $position = 0;
	private $results = array();

	public function addResult(Skyseek_iTunes_Result $result) {
		$this->results[] = $result;
	}

	/**
	 * Get result by sudo-type
	 *
	 * @param string $type Sudo-Type
	 *
	 * @return Skyseek_iTunes_Result
	 */
	public function get($type) {
		foreach($this->results as $result) 
			if($this->isType($result, $type))
				return $result;
			
		return false;
	}

	/**
	 * Get all results by sudo-type
	 *
	 * Some responses, especially from the lookup api, have mixed results. In the example below.
	 * The lookup call is for Keanu Reeves' movies. But the response also contains his actor info.
	 * So we can get just his movies by using the getAll() function.
	 *
	 *
	 * <b>Example</b>
	 *
	 * <code>
	 * $lookupAPI = new Skyseek_iTunes_Lookup_API();
	 * $results = $lookupAPI->getById(204872280, Skyseek_iTunes_EntityType::MOVIE);
	 *
	 * $actor = $results->get('Actor');
	 * $movies = $results->getAll('Movie');
	 * $movies->sort('name', false);
	 *
	 * //Get the artist object
	 * echo "<h1>{$actor->name}'s Movies</h1>";
	 *
	 * foreach($movies as $movie)
	 *     echo "<a href='{$movie->iTunesUrl}'>{$movie->name}</a><br />";
	 * </code>
	 *
	 * @param string $type
	 *
	 * @return Skyseek_iTunes_Result_Set
	 */
	public function getAll($type) {
		$return = new Skyseek_iTunes_Result_Set();

		foreach($this->results as $result)
			if($this->isType($result, $type))
				$return->addResult ($result);

		return $return;
	}

	/**
	 * Checks sudo-type of $result
	 *
	 * <b>Valid Sudo Types</b>
	 *
	 * <ul>
	 *     <li>Actor</li>
	 *     <li>Movie</li>
	 * </ul>
	 *
	 *
	 * @see isType
	 *
	 * @param Skyseek_iTunes_Result $result
	 * @param string $type
	 *
	 * @return boolean
	 */
	public function isType(Skyseek_iTunes_Result $result, $type) {

		switch($type) {
				case 'Actor':
					if($result instanceof Skyseek_iTunes_Result_Actor)
						return true;
				case 'Album':
					if($result instanceof Skyseek_iTunes_Result_Album)
						return true;
				case 'Movie':
					if($result instanceof Skyseek_iTunes_Result_Movie)
						return true;
				case 'Song':
					if($result instanceof Skyseek_iTunes_Result_Song)
						return true;
			}
	}
	
	private $sortProperty;
	private $sortAscending;

	/**
	 * Sort results by property
	 *
	 * @param string $propertyName
	 * @param boolean $ascending
	 */
	public function sort($propertyName, $ascending=true) {
		$this->sortProperty = $propertyName;
		$this->sortAscending = $ascending;
		usort($this->results, array($this, 'quickSort'));
	}

	private function quickSort($a, $b) {
		$sortProperty = $this->sortProperty;

		$al = strtolower($a->$sortProperty);
        $bl = strtolower($b->$sortProperty);

        if ($al == $bl)
            return 0;

		if($this->sortAscending)
			return ($al > $bl) ? +1 : -1;
		else
			return ($al > $bl) ? -1 : +1;
	}


	public function count() {
		return count($this->results);
	}

	public function seek($position) {
		$this->position = $position;

		if (!$this->valid())
			throw new OutOfBoundsException("invalid seek position ($position)");
	}

	public function rewind() {
		$this->position = 0;
	}

	public function current() {
		return $this->results[$this->position];
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->results[$this->position]);
	}

}
