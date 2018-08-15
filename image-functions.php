<?php
	include ("common.inc.php");
	include("lib_wideimg/WideImage.php");
	function cropImage($imagePath, $startX, $startY, $width, $height) {
	    $imagick = new \Imagick(realpath($imagePath));
	    $imagick->cropImage($width, $height, $startX, $startY);
	    header("Content-Type: image/jpg");
	    echo $imagick->getImageBlob();
	}

	$path = $_GET["path"];
	$action = $_GET["action"];

	if($action != "upload" && $action != "to_down" && $action != "to_del" && $action != "undo"){
		$filename = substr($path, strrpos($path, "/"));
		$dest = "img/upload/revert/".$filename;
		copy($path, $dest);		

		$im = ImageCreateFromJPEG($path);
	}	

	switch($action){		
		case "upload":
			if ( $_FILES['file']['name']  <> "" ){
			    $zugelassenedateitypen = array("image/png", "image/jpeg", "image/gif");	 
			    if (in_array( $_FILES['file']['type'] , $zugelassenedateitypen)){
			        move_uploaded_file (
			             $_FILES['file']['tmp_name'] ,
			             'img/upload/'. $_FILES['file']['name'] );	        	
			    }
			    header("location: index.php");
			}
			break;

		case "to_down":
			// download image
			if (file_exists($path)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename="'.basename($path).'"');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($path));
			    readfile($path);
			    exit;
			}
			header("location: index.php");
			break;

		case "to_del":
			$filename = substr($path, strrpos($path, "/"));
			$dest = "img/upload/revert/".$filename;
			unlink($path);
			unlink($dest);
			break;			

		case "to_grey":
			if($im && imagefilter($im, IMG_FILTER_GRAYSCALE)){
			    imagejpeg($im, $path);
			}
			break;

		case "to_mirror":
			imageflip($im, IMG_FLIP_HORIZONTAL);
			imagejpeg($im, $path);
			break;
		
		case "to_rotate":
			// rotate left/right		
			if($dir == "left"){
				$degrees = 90;
			} else {
				$degrees = 270;
			}		
			$rotate = imagerotate($im, $degrees, 0);
			imagejpeg($rotate, "$path");			
			break;		

		case "undo":			
			$filename = substr($path, strrpos($path, "/"));
			$dest = "img/upload/revert/".$filename;
			if(!file_exists($dest)) break;
			copy($dest, $path);
			break;

		case "to_crop":
			
			$src_x = intval(cleanParam($_POST["X"]),10);
			$src_y = intval(cleanParam($_POST["Y"]),10);
			$src_w = intval(cleanParam($_POST["width"]),10);
			$src_h = intval(cleanParam($_POST["height"]),10);

			$cropped=WideImage::load($im);

			$cropped = $cropped->crop($src_x, $src_y, $src_w, $src_h);

			$cropped->saveToFile($path);
			
	}	
	if($action != "upload" && $action != "to_down" && $action != "to_del" && $action != "undo"){
		imagedestroy($im);
	}
	
	header("location: index.php");

?>