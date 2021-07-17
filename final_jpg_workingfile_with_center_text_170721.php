<?php

include("dbconfig.php");
    $fnsout= new myDBC();






$Query="select * from dynamic_image_creation";
$checkout_result=$fnsout->SingleQuery($Query);



 while($checkout_row=mysqli_fetch_object($checkout_result)){
		 $img_pk=$checkout_row->img_pk;
		 $img_type=$checkout_row->img_type;
		 $img_text_from_db=$checkout_row->img_text;
		 $img_text = $img_text_from_db." USB Driver";
		 
		 
		 if($img_type=="mobile")
{
$img_src = "source_images/s_mobile.jpg";

$img_src_width = 296;
$img_src_height = 296;
//$img_text = "this is mobile text 909";

}


if($img_type=="tablet")
{
$img_src = "source_images/s_tab.jpg";

$img_src_width = 296;
$img_src_height = 296;
//$img_text = "this is tablet text 4567890";
}


if($img_type=="feature_phone")
{
$img_src = "source_images/s_featured_mobile.jpg";

$img_src_width = 296;
$img_src_height = 296;

}

$img_src_width = 296;
$img_src_height = 296;





$img_texts = strtolower($img_text);
$final_img_name = preg_replace('#[ -]+#', '-', $img_texts);

//$output = "dy_images/".$final_img_name.".png";
		 
		


//$img_src = "source_images/mobile.png";
$src = imagecreatefromjpeg($img_src);
$dest = imagecreatetruecolor(640, 340); // Create new empty image image with and height
// Set the background color of image
$background_color = imagecolorallocate($dest,  255, 255, 255); // set white background color for the new image
imagefill($dest, 0, 0, $background_color); // Fill background with above selected color
$text_color = imagecolorallocate($dest, 81, 124, 206); // Set the text color of image
//$text_color = imagecolorallocate($dest, 0, 0, 0); // Set the text color of image

//imagestring($dest, 3, 200, 280,  $img_text, $text_color); // Function to create image which contains string.


$font_f='Roboto-Medium.ttf';


$ypos = 330;

//exit;

$font = 5;

$font_width = ImageFontWidth($font);
$text_width = $font_width * strlen($img_text);

// Position to align in center
 $position_center = ceil((640 - $text_width) / 2);
 
 
 $final_img_texts =  ucwords($img_text);





imagettftext($dest, 14, 0, $position_center, $ypos, $text_color, $font_f, $final_img_texts);


imagecopy($dest, $src, 172, 0, 0, 0, $img_src_width, $img_src_height);// Image copy from source to destination last 2 param ins the src (mobile/tablet) image width and height
header('Content-Type: image/jpeg');
imagejpeg($dest);
$output = "dy_images/".$final_img_name.".jpg";
imagejpeg($dest, $output);
// Output and free from memory
imagedestroy($dest);
imagedestroy($src);
}


/*

// Create ZipArchive object
$zip = new ZipArchive();

// Create the zip file name
$filename="dy_images.zip";

if ($zip->open($filename, ZIPARCHIVE::CREATE )!=TRUE) 
{
  exit("cannot open <$archive_file_name>\n");
}

// Create the folder name
$dir = 'dy_images/';

createZip($zip,$dir);

// Create zip
function createZip($zip,$dir)
{
  if (is_dir($dir)){
  	if ($dh = opendir($dir)){
  	  while (($file = readdir($dh)) !== false){
  	    // If file
  	    if (is_file($dir.$file)){
  	      if($file != '' && $file != '.' && $file != '..'){
  	      	$zip->addFile($dir.$file);
  	      }
  	    }
  	    else
  	    {
  	      // If directory
  	      if(is_dir($dir.$file) ){
  	      	if($file != '' && $file != '.' && $file != '..'){
  	      	  // Add empty directory
  	      	  $zip->addEmptyDir($dir.$file);
  	      	  $folder = $dir.$file.'/';

  	      	  // Read data of the folder
  	      	  createZip($zip,$folder);
  	      	}
  	      }
  	    }
  	  }
  	  closedir($dh);
  	}
  }
}



// Download Created Zip file

   // $filename = "myfiles.zip";
   /* if (file_exists($filename)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filename));
        flush();
        ob_end_clean();
        readfile($filename);
        // delete file
        chmod($filename, 0644);
        if(unlink($filename)) echo "Deleted file ";
        //unlink($filename);
    }
    */

?>