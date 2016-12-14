<?php

$db_host = "localhost:3306";
$db_username = "cookiec7_cookiec";
$db_pass = "cookiecodeccsce4444";
$db_name = "cookiec7_db";

@mysql_connect("$db_host","$db_username","$db_pass") or die ("Coule not connect to MySQL");
@mysql_select_db("$db_name") or die ("No database");

echo"Successful Connection";

?>