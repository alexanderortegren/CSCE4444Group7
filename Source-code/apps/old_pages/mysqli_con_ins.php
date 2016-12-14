<?php

$mysqli = new mysqli('localhost:3306', 'cookiec7_cookiec', 'cookiecodeccsce4444', 'cookiec7_db');

if($mysqli->connect_error){
	die('Connect Error:' . $mysqli->connect_errno . ':' . $mysqli->connect_error);
}

$sql = "INSERT INTO members (username, email, bio) VALUES ('{$mysqli->real_escape_string($_POST['username'])}','{$mysqli->real_escape_string($_POST['email'])}','{$mysqli->real_escape_string($_POST['bio'])}'";
$insert = $mysqli->query($sql);

if($insert){
	echo"Success! Row ID:{mysqli->insert_id}";
}else{
	die("Error: {mysqli->errno} : {$mysqli->error}");
}

$mysqli->close();

?>

<form action = "" method="post">
	Name: <input name="username" type="text">
	Email: <input name="email" type="email">
	bio: <input name="bio" type="text">
	<input type="submit" value="Submit Form">
</form>