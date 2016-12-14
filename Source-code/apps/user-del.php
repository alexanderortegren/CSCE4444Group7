<?php
session_start();
include_once 'dbconnect.php';

//STORE IMAGE ID
$userID = $_GET['id'];

//DELETE IMAGE FROM THE FOLDER
	//RETRIEVE FILE PATH AND FILE NAME
 		$filePath = "../img/art/" . $userID;
 		echo $filePath;
 		if (rmdir($filePath)){
 			echo "User folder deleted";
 		}
 	
//DELETE IMAGE FROM TABLE
 	//$sql = "SELECT * FROM users WHERE id = '$userID'";
	$sql = "DELETE FROM users WHERE id = '$userID'";
	if (mysqli_query($con, $sql)) {
	    echo "DB entry deleted successfully";
	} else {
	    echo "Error: Image not found - " . mysqli_error($con);
	}
	sleep(5);
	echo '<script>window.location = "http://www.cookiecodec.x10host.com/apps/users.php";</script>';
?>

