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
class cropImage{
	function __construct(array $options)
	{
		$this->image_src = $options["image_src"];
		$this->new_image_src = $options["new_image_src"];
		$this->width = $options["width"];
		$this->height = $options["height"];
		$this->x = $options["x"];
		$this->y = $options["y"];
		$this->convertImage();
	}
	
	private function convertImage(){
		$type = explode(".", $this->image_src);
		$type = $type[count($type)-1];
		if ($type == "jpg" || $type == "jpeg" || $type == "JPG" || $type == "JPEG")
		{
			$img = imagecreatefromjpeg($this->image_src);
			$thumb = imagecreatetruecolor($this->width, $this->height);
			imagecopyresampled($thumb, $img, 0, 0, $this->x, $this->y, $this->width, $this->height, $this->width, $this->height);
			imagejpeg($thumb, $this->new_image_src);
			imagedestroy($img);
		}
		else if ($type == "png" || $type == "PNG")
		{
			$img = imagecreatefrompng($this->image_src);
			$thumb = imagecreatetruecolor($this->width, $this->height);
			$this->setTransparency($thumb, $img);
			imagecopyresampled($thumb, $img, 0, 0, $this->x, $this->y, $this->width, $this->height, $this->width, $this->height);
			imagepng($thumb, $this->new_image_src);
			imagedestroy($img);
		}
		else if ($type == "gif" || $type == "GIF")
		{
			$img = imagecreatefromgif($this->image_src);
			$thumb = imagecreatetruecolor($this->width, $this->height);
			$this->setTransparency($thumb, $img);
			imagecopyresampled($thumb, $img, 0, 0, $this->x, $this->y, $this->width, $this->height, $this->width, $this->height);
			imagegif($thumb, $this->new_image_src);
			imagedestroy($img);	
		}
		else
		{
			die("The selected image is not valid.");
		}
	}
	
	private function setTransparency($new_image, $image_source) 
    { 
        
		$transparencyIndex = imagecolortransparent($image_source); 
		$transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255); 
		 
		if ($transparencyIndex >= 0) { 
			$transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);    
		} 
		
		$transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']); 
		imagefill($new_image, 0, 0, $transparencyIndex); 
		imagecolortransparent($new_image, $transparencyIndex); 
        
    } 
	
	public function getNewImage(){
		return $this->new_image_src;
	}
}