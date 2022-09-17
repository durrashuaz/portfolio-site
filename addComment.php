<?php
session_start();
//only guests and admin can comment- sending error message to non logged in users
//if(!isset($_SESSION['status'])) {

//	$_SESSION['messagePostID'] = $_POST['postID'];
//	header('Location: /viewBlog.php');
//}
//else{
//echo $_SESSION['status'];
//echo $_SESSION['messagePostID'];

//get postID & (user)name from hidden input field of comment form
//get comment input from user
$postID = $_POST['postID'];
$username = $_POST['username'];
$name = $_POST['name'];
$commentText = $_POST['commentText'];

//Form connection with database
$dbhost = "localhost:3306";
$dbuser = "durrashu_admin";
$dbpass = "Deeznuts42069@";
$dbname = "durrashu_portfolio";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Checks connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//appropraitely format current time
$format = 'jS F Y, G:i e';
date_default_timezone_set('UTC');
$dateTime = date($format);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//insert all comment information into database
$sql = mysqli_query($conn,"INSERT INTO comments (postID, username, name, dateTime, comment) VALUES ( '$postID', '$username' ,'$name', '$dateTime', '$commentText')")
	or die("Query unsuccessful " . mysqli_error($conn));

	//query successful
		header('Location: /webroot/finalWebMini/viewBlog.php');
//}
}

$hello, my name is D




Hello, World 

?>
