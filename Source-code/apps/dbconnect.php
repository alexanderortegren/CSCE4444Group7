<?php
session_start();

//connect to mysql database
$con = mysqli_connect("localhost", "cookiec7_cookiec", "cookiecodeccsce4444", "cookiec7_db",3306) or die("Error " . mysqli_error($con));

//Webmaster Email
$mail_webmaster = 'example@example.com';

//Top site root URL
$url_root = 'http://cookiecodec.x10host.com/';

/******************************************************
-----------------Optional Configuration----------------
******************************************************/

//Home page file name
$url_home = 'http://cookiecodec.x10host.com/index.php';

//Design Name
$design = 'default';

?>