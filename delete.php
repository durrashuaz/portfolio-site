<?php

include 'connect.php';

//get hidden form inputs associated with delete request details
if(isset($_POST['postID'])){ //if submitted delete form is a blog post
	$postID = $_POST['postID'];
	echo $postID;
	//echo "this is the commentID" . $_POST['postID'];
}
if(isset($_POST['commentID'])){ //delete request is a comment
	$commentID = $_POST['commentID'];
	echo $commentID;
	//echo "this is the commentID" . $_POST['commentID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//delete post and its associated comments using postID
	//maybe need a seperate php post for this, bc then it might delete comment post id there
	//are filled
	if(isset($_POST['postID'])){
		$sql = mysqli_query($conn,"DELETE FROM POSTS WHERE id = '$postID'")
			or die("Query unsuccessful " . mysqli_error($conn));

		$sql = mysqli_query($conn,"DELETE FROM comments WHERE id = '$postID'")
			or die("Query unsuccessful " . mysqli_error($conn));
	}

	if( isset( $_POST['commentID'] ) ){ //delete request is a comment
		//delete comment using comment's ID
		$sql = mysqli_query( $conn, "DELETE FROM comments WHERE id = '$commentID'" )
			or die( "Query unsuccessful " . mysqli_error( $conn ) );
	}

	//query successful
		// header('Location: /webroot/finalWebMini/viewBlog.php');
		//change above
}

?>
