<?php
ob_start();
error_reporting(E_ALL);
require_once 'zipper_class.php';




include("dbconfig.php");
    $fnsout= new myDBC();
	

	/*if(isset($_POST['download_imgs']))
	{*/

	
		//cur_sessions


		$now = time();
$random = substr(md5(mt_rand(1,$now)), 0, 20);;
 $rand_op =  strtoupper($random);

$result = mkdir($rand_op);

if($result)
{
echo "folder created";
}
else{
echo "error while create folder";
}

		

		

		$get_csv_file_count = $_POST['csv_file_count'];

	



  $Query="select * from dynamic_image_creation order by img_pk desc limit $get_csv_file_count";
//exit;
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
$img_src = "source_images/s_featured_phone.jpg";

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
$dest = imagecreatetruecolor(640, 360); // Create new empty image image with and height
// Set the background color of image
$background_color = imagecolorallocate($dest,  255, 255, 255); // set white background color for the new image
imagefill($dest, 0, 0, $background_color); // Fill background with above selected color
$text_color = imagecolorallocate($dest, 81, 124, 206); // Set the text color of image
//$text_color = imagecolorallocate($dest, 0, 0, 0); // Set the text color of image

//imagestring($dest, 3, 200, 280,  $img_text, $text_color); // Function to create image which contains string.


//$font_f='Roboto-Medium.ttf';
//$font_f='OpenSans-ExtraBold.ttf';
//$font_f=__DIR__.'/Roboto-Medium.ttf';
$font_f=__DIR__.'/OpenSans-ExtraBold.ttf';


$ypos = 330;

//exit;

$font = 5;

$font_width = ImageFontWidth($font);
$text_width = $font_width * strlen($img_text);

// Position to align in center
 $position_center = ceil((640 - $text_width) / 2);

 $position_center = $position_center - 80;
 
 
 
 $final_img_texts =  ucwords($img_text);





imagettftext($dest, 26, 0, $position_center, $ypos, $text_color, $font_f, $final_img_texts);


imagecopy($dest, $src, 172, 0, 0, 0, $img_src_width, $img_src_height);// Image copy from source to destination last 2 param ins the src (mobile/tablet) image width and height
header('Content-Type: image/jpeg');
imagejpeg($dest);


$output = "$rand_op/".$img_text.".jpg";
//$output = "dy_images/".$final_img_name.".jpg";
imagejpeg($dest, $output);
// Output and free from memory
imagedestroy($dest);
imagedestroy($src);
}




// Include and initialize ZipArchive class

$zipper = new ZipArchiver;




// Path of the directory to be zipped
$dirPath = "$rand_op";

// Path of output zip file
$filename = "dyc-".$rand_op.".zip";

// Create zip archive
$zip = $zipper->zipDir($dirPath, $filename);

if($zip){
    echo 'ZIP archive created successfully.';
}else{
    echo 'Failed to create ZIP.';
}

// Download Created Zip file



   // $filename = "myfiles.zip";
   if (file_exists($filename)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filename));



		/*header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=$filename");
header("Content-length: " . filesize($filename));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile("$filename");*/


        flush();
        ob_end_clean();
		//ob_end_flush();
        readfile($filename);
        // delete file
        chmod($filename, 0644);
        //if(unlink($filename)) echo "Deleted file ";
        unlink($filename);
        

    }

    
    
    
    
    delete_files($rand_op);

/* 
 * php delete function that deals with directories recursively
 */
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
    
   


/*}
else{
	echo "something wrong";
}*/

?>


