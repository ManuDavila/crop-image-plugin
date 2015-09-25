<?php
/*  Copyright 2015 Crop Image Plugin  (email : manudg_1@msn.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require "cropImage.class.php";

$image_src = $_POST["image"];
$new_image_src = "thumb/thumb-".basename($image_src);
$width = intval($_POST["width"]);
$height = intval($_POST["height"]);
$x = intval($_POST["x"]);
$y = intval($_POST["y"]);

/* Set options */
$options = array(
	'image_src' => $image_src,
	'new_image_src' => $new_image_src,
	'width' => $width,
	'height' => $height,
	'x' => $x,
	'y' => $y,
);

$cropImage = new cropImage($options);

?>
<h3>Cropped image saved in the folder thumb :)</h3>
<hr />
<img src="<?php echo $cropImage->getNewImage() ?>" />