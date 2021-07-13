<?php

include("dbconfig.php");
    $fnsout= new myDBC();






$Query="select * from dynamic_image_creation";
$checkout_result=$fnsout->SingleQuery($Query);



 while($checkout_row=mysqli_fetch_object($checkout_result)){
		 $img_pk=$checkout_row->img_pk;
		 $img_type=$checkout_row->img_type;
		 $img_text=$checkout_row->img_text;
		 
		 
		 if($img_type=="mobile")
{
$img_src = "source_images/const_mobile.png";

$img_src_width = 132;
$img_src_height = 248;
//$img_text = "this is mobile text 909";

}


if($img_type=="tablet")
{
$img_src = "source_images/const_tab.png";

$img_src_width = 270;
$img_src_height = 201;
//$img_text = "this is tablet text 4567890";
}


if($img_type=="feature_phone")
{
$img_src = "source_images/const_feature_phone.png";

$img_src_width = 110;
$img_src_height = 199;

}





$img_texts = strtolower($img_text);
$final_img_name = preg_replace('#[ -]+#', '-', $img_texts);

//$output = "dy_images/".$final_img_name.".png";
		 
		


//$img_src = "source_images/mobile.png";
$src = imagecreatefrompng($img_src);
$dest = imagecreatetruecolor(640, 340); // Create new empty image image with and height
// Set the background color of image
$background_color = imagecolorallocate($dest,  255, 255, 255); // set white background color for the new image
imagefill($dest, 0, 0, $background_color); // Fill background with above selected color
$text_color = imagecolorallocate($dest, 0, 0, 0); // Set the text color of image

imagestring($dest, 3, 200, 280,  $img_text, $text_color); // Function to create image which contains string.
imagecopy($dest, $src, 150, 40, 0, 0, $img_src_width, $img_src_height);// Image copy from source to destination last 2 param ins the src (mobile/tablet) image width and height
header('Content-Type: image/png');
imagepng($dest);
$output = "dy_images/".$final_img_name.".png";
imagepng($dest, $output);
// Output and free from memory
imagedestroy($dest);
imagedestroy($src);
}
?>