<?php
session_start();
include_once 'dbconnect.php';


	//$userid = $_POST['userid'];
	$imageid = $_POST['imgid'];
	$userid = $_SESSION['usr_id'];



	//PULL FAVORITED IMAGES
	$result = mysqli_query($con, "SELECT imageID FROM favorites WHERE userID = '$userid'"); //'$_SESSION['usr_id']'");

	if($row = mysqli_fetch_assoc($result))
	{
		$favs = $row['imageID'];
		//convert the array into a string for comparing
		$favString = implode(",",$row);	//IS THIS IMAGE FAVORITES?

	
		// if(image is a favorite for the user)
		if(strpos($favString, $imageid) !== FALSE)
		{
			mysqli_query($con, "DELETE FROM favorites WHERE imageID = '$imageid' && userID = '$userid'");
		}
		else
		{
			mysqli_query($con, "INSERT INTO favorites(userID, imageID) VALUES ('" . $userid . "','" . $imageid ."')");		
		}

	}
	else
	{
		mysqli_query($con, "INSERT INTO favorites(userID, imageID) VALUES ('" . $userid . "','" . $imageid ."')");		

		
	}





?>