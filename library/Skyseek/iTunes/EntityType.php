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
 * @subpackage Supporting
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * EntityType
 *
 * @package    iTunes-API
 * @subpackage Supporting
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_EntityType {
	// +----------------------------------------------------------------------+
	// | Movie Entity Types                                                   |
	// +----------------------------------------------------------------------+

	/*
	 * Movie Entity Type
	 */
	const MOVIE = 'movie';

	/*
	 * Movie Entity Artist Type
	 */
	const MOVIE_ARTIST = 'movieArtist';


	// +----------------------------------------------------------------------+
	// | Podcast Entity Types                                                 |
	// +----------------------------------------------------------------------+

	/**
	 * Podcast Entity Type
	 */
	const PODCAST = 'podcast';

	/**
	 * Podcast Author Entity Type
	 */
	const PODCAST_AUTHOR = 'podcastAuthor';



	// +----------------------------------------------------------------------+
	// | Music Entity Types                                                   |
	// +----------------------------------------------------------------------+

	/**
	 * Music Track Entity Type
	 */
	const MUSIC_TRACK = 'musicTrack';

	/**
	 * Music Artist Entity Type
	 */
	const MUSIC_ARTIST = 'musicArtist';

	/**
	 * Music Album Entity Type
	 */
	const MUSIC_ALBUM = 'album';

	/**
	 * Music Video Entity Type
	 */
	const MUSIC_VIDEO = 'musicVideo';

	/**
	 * Music Mix Entity Type
	 */
	const MUSIC_MIX = 'mix';

	/**
	 * Music Song Entity Type
	 */
	const MUSIC_SONG = 'song';


	// +----------------------------------------------------------------------+
	// | Audio Book Entity Types                                              |
	// +----------------------------------------------------------------------+

	/**
	 * Audio Book Entity Type
	 */
	const AUDIOBOOK = 'audiobook';


	/**
	 * Audio Book Author Entity Type
	 */
	const AUDIOBOOK_AUTHOR = 'audiobookAuthor';

	// +----------------------------------------------------------------------+
	// | Short Film Entity Types                                              |
	// +----------------------------------------------------------------------+


	/**
	 * Short Film Entity Type
	 */
	const SHORT_FILM = 'shortFilm';

	/**
	 * Short Film Artist Entity Type
	 */
	const SHORT_FILM_ARTIST = 'shortFilmArtist';


	// +----------------------------------------------------------------------+
	// | TV Show Film Entity Types                                            |
	// +----------------------------------------------------------------------+


	/**
	 * TV Show Episode Entity Type
	 */
	const TV_SHOW_EPISODE = 'tvEpisode';

	/**
	 * TV Show Season Entity Type
	 */
	const TV_SHOW_SEASON = 'tvSeason';


	// +----------------------------------------------------------------------+
	// | Software Film Entity Types                                           |
	// +----------------------------------------------------------------------+


	/**
	 * Software Entity Type
	 */
	const SOFTWARE = 'software';


	/**
	 * iPad Software Entity Type
	 */
	const SOFTWARE_IPAD = 'iPadSoftware';


	/**
	 * Mac Software Entity Type
	 */
	const SOFTWARE_MAC = 'macSoftware';

	// +----------------------------------------------------------------------+
	// | E-Book Film Entity Types                                             |
	// +----------------------------------------------------------------------+

	/**
	 * E-Book Entity Type
	 */
	const EBOOK = 'ebook';
}
