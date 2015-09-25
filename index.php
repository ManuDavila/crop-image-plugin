<!--  Copyright 2015 Crop Image Plugin  (email : manudg_1@msn.com)

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
-->
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
		<link href='http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'/>
		<script src='http://code.jquery.com/jquery.js'></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src='http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
		
		
		<?php
			$image = "images/jpg.jpg";
			list($width, $height) = getimagesize($image);
			$max_width = $width;
			$min_width = $width / 2;
			$max_height = $height;
			$min_height = $height / 2;
		?>
		
		<script>
		
			$(function(){
				var _width;
				var _height;
				var _x;
				var _y;
				
				$( "#resize" ).resizable({
				  maxWidth: <?php echo $max_width ?>,
				  maxHeight: <?php echo $max_height ?>,
				  minWidth: <?php echo $min_width ?>,
				  minHeight: <?php echo $min_height ?>,
				  containment: "parent", 
				  create: function(event, ui){
					_width = $(this).width();
					_height = $(this).height();
					console.log("width: " + _width);
					console.log("height: " + _height);
					$("#preview").css({width: _width+"px", height: _height+"px"});
				  },
				  resize: function(event, ui){
					_width = ui.size.width;
					_height = ui.size.height;
					console.log("width: " + _width);
					console.log("height: " + _height);
					$("#preview").css({width: _width+"px", height: _height+"px"});
				  },
				});
				
				$( "#resize" ).draggable({ 
					containment: "parent", 
					create: function(event, ui){
						_x = $(this).offset().left - $("#box").offset().left;
						_y = $(this).offset().top - $("#box").offset().top;
						console.log("x: " + _x);
						console.log("y: " + _y);
						
						$("#preview").css({backgroundImage: "url(<?php echo $image ?>)", backgroundPosition: -_x + "px " + -_y + "px"});
					},					
					drag: function(event, ui){
						_x = ui.offset.left - $("#box").offset().left;
						_y = ui.offset.top - $("#box").offset().top;
						console.log("x = " + _x);
						console.log("y = " + _y);
						$("#preview").css({backgroundImage: "url(<?php echo $image ?>)", backgroundPosition: -_x + "px " + -_y + "px"});
					},
				});
				
			
			$("#btn").on("click", function(){
				$.post("cropImage.ajax.php", {image: "<?php echo $image ?>", width: _width, height: _height, x: _x, y: _y}, function(data){
					$("#request").html(data);
				});
			});
			
			});
		</script>
		<style>
			#box{
				background-image: url("<?php echo $image ?>");
				background-repeat: no-repeat;
				width: <?php echo $width ?>px;
				height: <?php echo $height ?>px;
				border: 1px solid #7E9EC7;
			}
			#resize{
				width: <?php echo $width ?>px;
				height: <?php echo $height ?>px;
				border: 1px dashed #EE4040;
			}
			
			#preview{
				background-repeat: no-repeat;
				border: 1px solid #7E9EC7;
			}
		</style>
	</head>
	<body>
		<div class="container">
		<h1>Crop Image with PHP and jQuery UI</h1>
		<blockquote>Select the image area (drag and resize) to cut and then send the data to create the new cropped image.</blockquote>
		<div class="row">
		<div class="col-md-5">
		<div class="text-info">Supported image types: jpg, jpeg, png and gif</div>
		<div class="text-info">Requeriments: PHP 5.x and GD Graphics Library</div>
		</div>
		<div class="col-md-3">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick" />
		<input type="hidden" name="hosted_button_id" value="L69XJQN5GX6H6" />
		<button type="submit" class="btn btn-primary">DONATE <span class="glyphicon glyphicon-thumbs-up"></span></button>
		</form>
		</div>
		<div class="col-md-2">
		<a href="https://es.linkedin.com/pub/manuel-jesús-dávila-gonzález/65/2b6/bb0" target="_blank">Author: Manuel J. Dávila</a>
		</div>
		</div>
		<hr />
		<div id="request">
		<div class="row">
		<div class="col-md-5">
		<div id="box"><div id="resize"></div></div>
		</div>
		<div class="col-md-5">
		<h3>Preview</h3>
		<div id="preview"></div>
		<hr />
		<button type="button" class="btn btn-primary" id="btn"><span class="glyphicon glyphicon-save"></span></button>
		</div>
		</div>
		</div>
		<br />
		<br />
		</div>
	
	</body>
</html>