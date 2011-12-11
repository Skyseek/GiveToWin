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
 * @package    Skyseek
 * @subpackage Core
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */



/**
 * Skyseek_Image
 *
 * @package    Skyseek
 * @subpackage Core
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Image {

		/**
	 * Portable Network Graphics (PNG) is a bitmapped image format and video codec
	 * that employs lossless data compression. PNG was created to improve upon and replace
	 * GIF (Graphics Interchange Format) as an image-file format not requiring a patent license.
	 * The PNG acronym is optionally recursive.
	 */
    const PNG = 'png';

	/**
	 * In computing, JPEG is a commonly used method of lossy compression for digital photography
	 * (image). The degree of compression can be adjusted, allowing a selectable tradeoff between
	 * storage size and image quality. JPEG typically achieves 10:1 compression with
	 * little perceptible loss in image quality.

	 */
	const JPEG = 'jpg';

	/**
	 * The Graphics Interchange Format (GIF) is a bitmap image format that was introduced by
	 * CompuServe in 1987 and has since come into widespread usage on the World Wide Web.
	 */
	const GIF = 'gif';
	

	/**
	 * GD Image Resource
	 *
	 * @var resource
	 */
	public $image;


	/**
	 * Current Image Width
	 *
	 * @var int
	 */
	public $width;

	/**
	 * Current Image Height
	 *
	 * @var int
	 */
	public $height;


	public function __construct($image=null) {
		if(!is_resource($image))
			$image = imagecreatefromstring($image);

		$this->setImage($image);
	}
	
	public function setImage($image) {
		if(!is_resource($image))
			throw new Skyseek_Exception("Invalid Image. Must be a GD Resource");

		$this->image = $image;
		$this->width = imagesx($image);
		$this->height = imagesy($image);
	}

	/**
	 * Resize Image to new Size
	 *
	 * @param int $width New Width
	 * @param int $height New Height
	 */
	public function resizeTo($width, $height=null) {

		if($height === null)
			$height = ($this->height / $this->width) * $width;

		$newImage = imagecreatetruecolor($width, $height);

		//Transparency
		imagealphablending($newImage, false);
		imagesavealpha($newImage, true);
		 $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
		imagefilledrectangle($newImage, 0, 0, 200, 200, $transparent);

		//Copy (Resampled)
		imagecopyresampled($newImage, $this->image , 0, 0, 0, 0, $width, $height, $this->width, $this->height);

		//Set the new image.
		$this->setImage($newImage);
	}

	/**
	 * Save image to file
	 *
	 * @param filename $fileName The path to save the file to. If not set or NULL, the raw image stream will be outputted directly.
	 * @param string $type Image Type(jpeg,gif,png)
	 * @param int $quality JPEG-ONLY: quality is optional, and ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
	 */
	public function saveToFile($fileName, $type = Skyseek_Image::PNG, $quality=75) {
		switch($type) {
			case self::PNG:
				imagepng($this->image, $fileName);
				break;
			case self::GIF:
				imagegif($this->image, $fileName);
				break;
			case self::JPEG:
				imagejpeg($this->image, $fileName, $quality);
				break;
			default:
				throw new Skyseek_Exception("Unknown Image Type '$type'");
		}
	}

	/**
	 * Output image to browser
	 *
	 * @param string $type Image Type(jpeg,gif,png)
	 * @param int $quality JPEG-ONLY: quality is optional, and ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
	 */
	public function outputToBrowser($type = Skyseek_Image::PNG, $quality=75) {
		switch($type) {
			case self::PNG:
				header("Content-Type: image/png");
				imagepng($this->image);
				break;
			case self::GIF:
				header("Content-Type: image/gif");
				imagegif($this->image);
				break;
			case self::JPEG:
				header("Content-Type: image/jpeg");
				imagejpeg($this->image, NULL, $quality);
				break;
			default:
				throw new Skyseek_Exception("Unknown Image Type '$type'");
		}
	}
}
