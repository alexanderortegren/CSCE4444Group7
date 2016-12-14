<?php
session_start();
include_once 'dbconnect.php';

	$userid = $_POST['userid'];
	$imageID = $_POST['imgid'];

	$return_val = 0;	// return 0 if not found(not favorite) 1 if favorite
	
	//PULL FAVORITED IMAGES
	$result = mysqli_query($con, "SELECT imageID FROM favorites WHERE userID = '$userid'"); //'$_SESSION['usr_id']'");

	if($row = mysqli_fetch_assoc($result))
	{
		$favs = $row['imageID'];
		//convert the array into a string for comparing
		$favString = implode(",",$row);	//IS THIS IMAGE FAVORITES?

	
		// if(image is a favorite for the user)
		if(strpos($favString, $imageID) !== false)
		{
			$return_val = 1;
		}

	}
	echo json_encode($return_val);
	//echo $return_val;
	//return $return_val;

?>