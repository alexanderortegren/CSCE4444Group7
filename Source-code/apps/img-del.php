<?php
session_start();
include_once 'dbconnect.php';

//STORE IMAGE ID
$imgID = $_GET['id'];

//DELETE IMAGE FROM THE FOLDER
	//RETRIEVE FILE PATH AND FILE NAME
	$result = mysqli_query($con, "SELECT imgName, imgPath FROM images WHERE id = '$imgID'");
 	if ($row = mysqli_fetch_array($result)) {
 		$fileName = $row['imgName'];
 		$filePath = "../" . $row['imgPath'];
 		echo $fileName . "   " . $filePath;
 		unlink($filePath);
 	}
 	
//DELETE IMAGE FROM TABLE
	$sql = "DELETE FROM images WHERE id = '$imgID'";
	if (mysqli_query($con, $sql)) {
	    echo "Image deleted successfully";
	} else {
	    echo "Error: Image not found - " . mysqli_error($con);
	}

	echo '<script>window.location = "http://www.cookiecodec.x10host.com/apps/gallery.php";</script>';
?>

