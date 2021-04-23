<?php
$servername = "localhost";
$username = "wwwkinne_kin";
$password = "_$^($7X@T}&{";

// Create connection
$conn = mysql_connect($servername, $username, $password)
  or die("Unable to connect to MySQL");

/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
$imgUrl = $_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];

$jpeg_quality = 100;

$output_filename = "coverphotos/croppedImg_".rand();

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

$what = getimagesize($imgUrl);

switch(strtolower($what['mime']))
{
    case 'image/png':
        $img_r        = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
        $img_r        = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		error_log("jpg");
		$type = '.jpeg';
        break;
		
	case 'image/jpg':
        $img_r        = imagecreatefromstring($imgUrl);
		$source_image = imagecreatefromstring($imgUrl);
		$type = '.jpg';
        break;
    case 'image/gif':
        $img_r        = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported');
}


//Check write Access to Directory

if(!is_writable(dirname($output_filename))){
	$response = Array(
	    "status" => 'error',
	    "message" => 'Can`t write cropped File'
    );	
}else{

    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
	$response = Array(
	    "status" => 'success',
	    "url" => "/public/croppic/".$output_filename.$type,
		"userInfo" => $info
    );
}
$sqlInsertImage = "INSERT INTO engine4_storage_files
				   (
				    type,
					parent_type,
					parent_id,
					user_id, 
					creation_date, 
					modified_date, 
					service_id, 
					storage_path, 
					extension, 
					name, 
					mime_major, 
					mime_minor, 
					size, 
					hash)
				   VALUES
				   (
				    'cover_brand',
					'cover_brand', 
					'".$_GET['user_id']."', 
					'".$_GET['user_id']."', 
					'".date('Y-m-d H:i:s')."', 
					'".date('Y-m-d H:i:s')."', 
					0, 
					'public/croppic/".$output_filename.$type."', 
					'".$type."', 
					'".$type."', 
					'image', 
					'jpeg', 
					'208', 
					'8752917' )";
//select a database to work with
$db = mysql_select_db("wwwkinne_kinnect2",$conn)
  or die("Could not select wwwkinne_kinnect2");
  
//execute the sql query
$result = mysql_query($sqlInsertImage);

$cropped_cover_file_id = mysql_insert_id();

if($cropped_cover_file_id != "" && $_GET['user_id'] != ''){
	$sqlUpdateCoverPhoto = "UPDATE engine4_users SET cover_photo_id = ".$cropped_cover_file_id." WHERE user_id= ".$_GET['user_id']." ";
	$result = mysql_query($sqlUpdateCoverPhoto);
	
	//`type`, `subject_type`, `subject_id`, `object_type`, `object_id`, `body`,
	// cover_photo_update
	
	$sqlInsertActivityCover = "INSERT INTO engine4_activity_actions
				   (
				    type,
					subject_type,
					subject_id,
					object_type, 
					object_id, 
					body,
					date
					)
				   VALUES
				   (
				    'cover_photo_update',
					'user', 
					'".$_GET['user_id']."',
					'user', 
					'".$_GET['user_id']."', 
					'{item:\$subject} added a new profile photo.', 					
					'".date('Y-m-d H:i:s')."' 
				   )";
	$coverPhotoResult = mysql_query($sqlInsertActivityCover);
	
}
print json_encode($response);