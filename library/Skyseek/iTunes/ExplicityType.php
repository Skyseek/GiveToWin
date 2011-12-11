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
 * ExplicityType
 * 
 * The Recording Industry Association of America (RIAA) parental advisory for the content 
 * returned by the search request.
 *
 * For more information, see
 * @see http://itunes.apple.com/WebObjects/MZStore.woa/wa/parentalAdvisory
 *
 * @package    iTunes-API
 * @subpackage Supporting
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_iTunes_ExplicityType {
	/**
	 * Explicit lyrics, possibly explicit album cover
	 */
    const EXPLICIT = 'explicit';

	/**
	 * Explicit lyrics "bleeped out"
	 */
	const CLEANED = 'cleaned';

	/**
	 * No explicit lyrics
	 */
	const NOT_EXPLICIT = 'notExplicit';
}
