<?php

include 'includes/connect.php';
session_start();

//only guests and admin can comment- sending error message to non logged in users
//if(!isset($_SESSION['status'])) {

//	$_SESSION['messagePostID'] = $_POST['postID'];
//	header('Location: /viewBlog.php');
//}
//else{
//echo $_SESSION['status'];
//echo $_SESSION['messagePostID'];
//ad test

//get postID & (user)name from hidden input field of comment form
//get comment input from user

$postID = $_POST['postID'];
$username = $_POST['username'];
$commentText = $_POST['commentText'];

//set current time in appropriate format
date_default_timezone_set('GMT');
$dateTime = date("Y-m-d H:i:s");

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	//insert all comment information into database
	$sql = mysqli_query($conn,"INSERT INTO comments ( postId, username,  dateTime, comment ) VALUES ( '$postID', '$username' ,'$dateTime', '$commentText')")
		or die("Query unsuccessful " . mysqli_error($conn));

	//query successful
	$previous_url = $_SERVER[HTTP_REFERER];
	header('Location: ' . $previous_url );

}



?>
