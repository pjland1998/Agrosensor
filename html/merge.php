<?php

if (isset($_POST["image"])) {
	
	// Create image instances 
	$dest = imagecreatetruecolor(400, 400); 
	$src = imagecreatefrompng($_POST['image']); 
  
	// Copy and merge 
	$src_width = imagesx ($src);
	$src_height = imagesy ($src);
	$dest_width = imagesx ($dest);
	$dest_height = imagesy ($dest);
	
	$xoffset = abs($dest_width - $src_width) / 2;
	$yoffset = abs($dest_height - $src_height) / 2;
			
	imagecopymerge($dest, $src, $xoffset, $yoffset, 0, 0, $src_width, $src_height, 100);
	
	$imageName = time() . '.png';

	imagepng($dest, 'images/'.$imageName); // have to save it to images folder because we changed the owner of the folder to www-data so now we can upload to it. Can't upload directly to html folder
	imagedestroy($dest);
	imagedestroy($src);

	echo '<img src="images/'.$imageName.'" class="merged_thumbnail" />';

}

?>