<?php
function resize($blob_binary, $desired_width, $desired_height) {
	
	// simple function for resizing images to specified dimensions
	
    $im = imagecreatefromstring($blob_binary);
    $new = imagecreatetruecolor($desired_width, $desired_height);
    $x = imagesx($im);
    $y = imagesy($im);
    imagecopyresampled($new, $im, 0, 0, 0, 0, $desired_width, $desired_height, $x, $y);
    imagedestroy($im);
    imagejpeg($new, null, 85);
    echo $new;
}
?>