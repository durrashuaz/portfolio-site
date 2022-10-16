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

	$lastComment = mysqli_query( $conn, "SELECT * FROM comments ORDER BY ID DESC LIMIT 1" )
	or die( "Query unsuccessful sdfsdf" . mysqli_error( $conn ) );

	if( $lastComment -> num_rows > 0 ){
		while( $row = mysqli_fetch_assoc( $lastComment) ){
			echo $row['id']; 
			$commentID = $row['id']; 
		}
	}

	// var_dump($commentID);

	//find post associated with comment
	$projectWithCommentID = mysqli_query($conn, "SELECT * FROM projects WHERE id = $commentID")
		or die("Query unsuccessful " . mysqli_error($conn));

	if( $projectWithCommentID -> num_rows > 0 ){
		while( $row = mysqli_fetch_assoc( $projectWithCommentID ) ){
			echo $row['title'];
			$project_title = $row['title'];
		}
	}

	echo $project_title;

	//convert title to file path
	$project_title = str_replace( " ", "-", $project_title );
	$project_title = strtolower( $project_title );
	$project_url= $project_title . '.php';

	//query successful
	// header('Location: ' . $project_url );

}



?>
