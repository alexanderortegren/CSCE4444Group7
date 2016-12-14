<html>
<head>
<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <!--CUSTOM CSS-->
    <link href="/css/cookie.css" rel="stylesheet" type="text/css"/>
</head>
<?php
session_start();
/*  taken from website:
    http://www.w3schools.com/php/php_file_upload.asp
    
    edited by Alexander Ortegren, 10/11/2016
*/
include_once '../dbconnect.php';
include "../../lib/wide-image/WideImage.php";

//set validation error flag as false
$error = false;


//Retrieve currently logged in users USERID (to use with target directory)
$name = $_SESSION['usr_name'];
$email = $_SESSION['usr_email'];
$sql = "SELECT id FROM users WHERE email = '$email'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
//echo $row['id'];

$target_dir = "../../img/art/" . $row['id'] . "/";   //stupid extra slash was missing
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
		$_SESSION['Error'] = "File is not an image.";
	 $error = true;
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $file_exist_error = "Sorry, file already exists.";
	$_SESSION['Error'] = "Sorry, file already exists.";
    $error = true;
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    //echo "Sorry, your file is too large.";
    $file_too_big_error = "Sorry, your file is too large.";
	$_SESSION['Error'] = "Sorry, your file is too large.";
    $error = true;
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $file_format_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$_SESSION['Error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $error = true;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

	if( isset($_SESSION['Error']) )
	{
       ?> <div style="text-align:center;"> <?php echo $_SESSION['Error'];?> </div> <?php

		
        unset($_SESSION['Error']);
	}
    $error = true;
    //$file_not_uploaded_error = "Sorry, your file was not uploaded.";
	
	
    header("refresh:3; url=http://www.cookiecodec.x10host.com/apps/gallery.php");
    //exit();
}    
// if everything is ok, try to upload file
else 
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$img = WideImage::load($target_file);
		$watermark = WideImage::load("watermark.png");
		
		list($width, $height) = getimagesize($target_file);
		$resized = $watermark->resize($width, $height, 'fill');
		
		$new = $img->merge($resized, 'center', 'center', 100);	// changed from 'center', 'center', 100
		$new->saveToFile($target_file);
			//header("Location: http://www.cookiecodec.x10host.com/apps/gallery.php");

		//header("refresh:5; url=http://www.cookiecodec.x10host.com/apps/gallery.php");
		$successmsg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		//ADD IMAGE INFORMATION TO DB
		$timestamp = time();
		$imgFileName = basename( $_FILES["fileToUpload"]["name"]);
		$imgName = $imgFileName;
		$imgOwner = $_SESSION['usr_username'];
		//Remove ../../ from $target_file, and store the file path
		$filePath = substr($target_file, 6);
		mysqli_query($con, "INSERT INTO images(timestamp,imgName,imgFileName,imgOwner,imgPath) VALUES('" . $timestamp . "','" . $imgName . "','" . $imgFileName . "', '" . $imgOwner . "', '" . $filePath . "')");
		//GET OUR NEW IMAGES ID
		$imgId = mysqli_query($con, "SELECT id FROM images WHERE imgName = '$imgName'");
		$imgId = mysqli_fetch_assoc($imgId);
		$imgId = $imgId['id'];
		//SET OUR IMAGES FILE PERMISSIONS FOR VIEWING
		//LETS REDIRECT TO img-edit FOR OUR NEW IMAGE
		$redirect = "http://www.cookiecodec.x10host.com/apps/img-edit.php?id=" . $imgId;
		echo '<script>window.location = "'.$redirect.'";</script>';
	} 
	else 
	{
        //header("refresh:3; url=http://www.cookiecodec.x10host.com/index.php");
        $error = true;
        $errormsg = "Sorry, there was an error uploading your file.";
		$_SESSION['Error'] = "Sorry, there was an error uploading your image.";

		if( isset($_SESSION['Error']) )
		{
		?> <div style="text-align:center;"> <?php echo $_SESSION['Error'];?> </div> <?php
			unset($_SESSION['Error']);
		}
		
        header("refresh:3; url=http://www.cookiecodec.x10host.com/apps/gallery.php");
        //exit();
    }

}

?>
</html>