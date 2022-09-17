<?php

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

//Form connection with database
$dbhost = "localhost:3306";
$dbuser = "durrashu_admin";
$dbpass = "Deeznuts42069@";
$dbname = "durrashu_portfolio";

//Creates connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Checks connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//delete post and its associated comments using postID
	//maybe need a seperate php post for this, bc then it might delete comment post id there
	//are filled
	if(isset($_POST['postID'])){
		$sql = mysqli_query($conn,"DELETE FROM POSTS WHERE postID = '$postID'")
			or die("Query unsuccessful " . mysqli_error($conn));

		$sql = mysqli_query($conn,"DELETE FROM comments WHERE postID = '$postID'")
			or die("Query unsuccessful " . mysqli_error($conn));
	}

if(isset($_POST['commentID'])){ //delete request is a comment
	//delete comment using comment's ID
	$sql = mysqli_query($conn,"DELETE FROM comments WHERE ID = '$commentID'")
		or die("Query unsuccessful " . mysqli_error($conn));
}

	//query successful
		header('Location: /webroot/finalWebMini/viewBlog.php');
		//test
}

?>
