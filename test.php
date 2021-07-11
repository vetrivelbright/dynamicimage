<?php
error_reporting(E_ALL);
$image = imagecreate(640, 360);
   

$background_color = imagecolorallocate($image, 255, 255, 255);
   
// Set the text color of image
$text_color = imagecolorallocate($image, 0, 0, 0);
   
// Function to create image which contains string.
imagestring($image, 5, 10, 330,  "Vetrivel samidurai", $text_color);
//imagestring($image, 3, 160, 120,  "A computer science portal", $text_color);
   
header("Content-Type: image/png");
 imagepng($image);  
imagepng($image, 'abc.png');
imagedestroy($image);


?>

<?php
/*
$img = imagecreatetruecolor(640, 360);
imagesavealpha($img, true);
$color = imagecolorallocatealpha($img, 0, 0, 0, 127);
imagefill($img, 0, 0, $color);
header("Content-Type: image/png");
imagepng($img, 'test.png');
*/
?>