<?php

function createDynamic_image()

{

//Let's generate a totally random string using md5
$md5 = md5(rand(0,999)); 

//We don't need a 32 character long string so we trim it down to 5
$pass = substr($md5, 10, 5); 

//Set the image width and height
$width = 640;
$height = 360; 

//Create the image resource
$image = ImageCreate($width, $height);  

//We are making three colors, white, black and gray

$white = ImageColorAllocate($image, 255, 255, 255);

$black = ImageColorAllocate($image, 0, 0, 0);

$grey = ImageColorAllocate($image, 204, 204, 204);

//Make the background black
ImageFill($image, 0, 0, $white); 

//Add randomly generated string in white to the image
ImageString($image, 3, 30, 3, $pass, $black); 

//Throw in some lines to make it a little bit harder for any bots to break
//ImageRectangle($image,0,0,$width-1,$height-1,$grey); 

//imageline($image, 0, $height/2, $width, $height/2, $grey); 

//imageline($image, $width/2, 0, $width/2, $height, $grey); 
 
//Tell the browser what kind of file is come in 
header("Content-Type: image/png"); 

//Output the newly created image in jpeg format
Imagepng($image);
   
//Free up resources
ImageDestroy($image);

}
 
//createDynamic_image();


       $photo_to_paste="aaa.png";  //image 321 x 400 - vector image
       $white_image="abc.png"; //873 x 622 white background with text

        $im = imagecreatefrompng($white_image);
         $condicion = GetImageSize($photo_to_paste); // image format?
         
         //print_r($condicion);
         
         /* if($condicion[2] == 1) //gif
        $im2 = imagecreatefromgif("$photo_to_paste");
        if($condicion[2] == 2) //jpg
        $im2 = imagecreatefromjpeg("$photo_to_paste");
        if($condicion[2] == 3) //png
        $im2 = imagecreatefrompng("$photo_to_paste");
        */

      
        $im2 = imagecreatefrompng("$photo_to_paste");

        imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
header("Content-Type: image/png");
 imagepng($im);
        imagepng($im,"test4.png");
        imagedestroy($im);
        imagedestroy($im2);

?>
