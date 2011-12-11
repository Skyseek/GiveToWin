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
 * PropertyType
 *
 * @package    iTunes-API
 * @subpackage Supporting
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_PropertyType {
	/**
	 * Magicical "All" Search Property
	 */
	const ALL = 'all';

	/**
	 * Actor Search Property
	 *
	 * Search's Actor Name
	 */
	const ACTOR = 'actorTerm';

	/**
	 * Album Search Property
	 *
	 * Search's Album Name
	 */
	const ALBUM = 'albumTerm';
	const ARTIST = 'artistTerm';
	const AUTHOR = 'authorTerm';
	const COMPOSER = 'composerTerm';
	const DESCRIPTION = 'descriptionTerm';
	const DIRECTOR = 'directorTerm';
	const FEATURE_FILM = 'featureFilmTerm';
	const GENRE_INDEX = 'genreIndex';
	const KEYWORDS = 'keywordsTerm';
	const LANGUAGE = 'languageTerm';
	const MIX = 'mixTerm';
	const MOVIE = 'movieTerm';
	const MOVIE_ARTIST = 'movieArtistTerm';
	const MUSIC_TRACK = 'musicTrackTerm';
	const PRODUCER = 'producerTerm';
	const RATING_INDEX = 'ratingIndex';
	const RATING = 'ratingTerm';
	const RELEASE_YEAR = 'releaseYearTerm';
	const SHORT_FILM = 'shortFilmTerm';
	const SHOW = 'showTerm';
	const SOFTWARE_DEVELOPER = 'softwareDeveloper';
	const SONG = 'songTerm';
	const TITLE = 'titleTerm';
	const TV_EPISODE = 'tvEpisodeTerm';
	const TV_SEASON = 'tvSeasonTerm';
}
