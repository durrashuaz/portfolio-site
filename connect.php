<?php

//Form connection with database
// $dbhost = "localhost:3306";
// $dbuser = "durrashu_admin";
// $dbpass = "Deeznuts42069@";
// $dbname = "durrashu_portfolio";

$dbhost = "0.0.0.0:5612";
$dbuser = "root";
$dbpass = "password";
$dbname = "portfolio";

///Creates connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Checks connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

?>