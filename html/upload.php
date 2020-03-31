<?php


if(isset($_POST["image"]))
{
	$data = $_POST["image"];

	
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);
	
	$imageName = time() . '.png';
	
	//file_put_contents('images/'.$imageName, $data);
	
	$src = imagecreatefromstring($data); //Since $data is not saved in png form but is rather a base64 string
  
	// Copy and merge 
	$src_width = imagesx ($src);
	$src_height = imagesy ($src);
	
	$dest = imagecreatetruecolor(400, $src_height); 

	$dest_width = imagesx ($dest);
	$dest_height = imagesy ($dest);
	

	
	$xoffset = abs($dest_width - $src_width) / 2;
	$yoffset = abs($dest_height - $src_height) / 2;
			
	imagecopymerge($dest, $src, $xoffset, $yoffset, 0, 0, $src_width, $src_height, 100);
	
	$trueImage = time() . '.png';

	imagepng($dest, 'images/'.$trueImage); // have to save it to images folder because we changed the owner of the folder to www-data so now we can upload to it. Can't upload directly to html folder
	imagedestroy($dest);
	imagedestroy($src);
	
	echo '<img src="images/'.$trueImage.'" class="img-thumbnail" />';
 


}

?>