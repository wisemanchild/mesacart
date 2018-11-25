<!--
*
HTML FILE INFO
	* Application: final 173 ecommerce project 
	* Description: code for the prototype
	* File Name: thumbnail.php 
	* Author: mesacart original:
	* Date created: 10 - 28 - 2019 Date updated: 10 - 28 - 2019 
	* Time created: 12: 38 pm Time updated: 12: 38 pm 
	* Revisions: 1.0 
	* Copyright: ( c )2018 Norlab Business Solutions 
	* 
-->
<?php
$pic = $_GET['pic'];
$max_height = $_GET['wd'];
$max_width = $_GET['ht'];
if (!$max_height) $max_height='75';
if (!$max_width) $max_width='75';

$size= getimagesize($pic);
$width_ratio  = ($size[0] / $max_width);
$height_ratio = ($size[1] / $max_height);
 
if($width_ratio >=$height_ratio) 
{
   $ratio = $width_ratio;
}
else
{
   $ratio = $height_ratio;
}

$new_width    = ($size[0] / $ratio);
$new_height   = ($size[1] / $ratio);


Header("Content-Type: image/jpeg");


$src_img = imagecreatefromjpeg($pic);
$thumb = imagecreatetruecolor($new_width,$new_height);
imagecopyresampled($thumb, $src_img, 0,0,0,0,$new_width,$new_height,$size[0],$size[1]);
imagejpeg($thumb);
imagedestroy($src_img);
imagedestroy($thumb);
?> 







