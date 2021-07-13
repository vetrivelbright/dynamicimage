<?php



for($i=1;$i<=6;$i++)
{

$img_src = "source_images/mobile.png";
$src = imagecreatefrompng($img_src);
$dest = imagecreatetruecolor(640, 340); // Create new empty image image with and height
// Set the background color of image
$background_color = imagecolorallocate($dest,  255, 255, 255); // set white background color for the new image
imagefill($dest, 0, 0, $background_color); // Fill background with above selected color
$text_color = imagecolorallocate($dest, 0, 0, 0); // Set the text color of image
$dy_text = "A Computer Science Portal".$i;
$img_texts = strtolower($dy_text);
$final_img_name = preg_replace('#[ -]+#', '-', $img_texts);
imagestring($dest, 3, 200, 280,  $dy_text, $text_color); // Function to create image which contains string.
imagecopy($dest, $src, 150, 40, 0, 0, 300, 200);// Image copy from source to destination last 2 param ins the src (mobile/tablet) image width and height
header('Content-Type: image/png');
imagepng($dest);
$output = "dy_images/".$final_img_name.".png";
imagepng($dest, $output);
// Output and free from memory
imagedestroy($dest);
imagedestroy($src);
}
?>