<?php

include 'connect.php';

//if(!isset($_SESSION)) { //
//	session_start();
//}
//if (isset($_SESSION['user'])){//
//	if($_SESSION['user'] === "admin"){//only admins can post blogs (incase user types in addPost URL) //

//Connection Success
	//generate a postID
		//select last postID from database and increment, if none, ID = 100 (to avoid confusion with primary ID)
$sql = mysqli_query( $conn, "SELECT  * FROM projects" )
	or die( "Query unsuccessful " . mysqli_error( $conn ) );

if( $sql -> num_rows > 0 ){  //if table has row(s)
echo "<p>more than 0 rows</p>";
	$lastrow = mysqli_query( $conn,"SELECT * FROM projects ORDER BY id DESC LIMIT 1" )
	or die( "Query unsuccessful " . mysqli_error( $conn ) );

		while( $row = mysqli_fetch_assoc( $lastrow ) ){
			$id = $row['id'] + 2;  //last postID is incremented by 2
		}
} else {
	$id = 100; //blog post IDs increment from start value of 100
}

//upload request is from submit form
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	echo "<p> request method pos sadasdt</p>";

	//get form data input
	$title = $_POST["title"];
	$subtitle = $_POST["subtitle"];
	$content = $_POST["projectText"];

	//set current time in appropriate format
	date_default_timezone_set('GMT');
	$dateTime = date("Y-m-d H:i:s");

	//insert all post information into database
	$sql = mysqli_query( $conn,"INSERT INTO projects (id, dateTime, title, subtitle, content) VALUES ( '$id', '$dateTime',  '$title', '$subtitle', '$content' )" )
		or die( "Query unsuccessful " . mysqli_error( $conn ) );

} else { //upload is from preview upload REMEMBER TO UPDATE THE VAR NAMES TO SUIT PROJECT INSTEAD OF BLOG!!

	session_start();

	if(isset($_SESSION['previewTitle']) && isset($_SESSION['previewBlog']) && isset($_SESSION['time'])) {
		$dateTime = $_SESSION['time'];  //depends if they want the time from the original, or when it is posted, makes sense if it is posted
		$title = $_SESSION['previewTitle'];
		$blog = $_SESSION['previewBlog'];

		//insert all post information into database
		$sql = mysqli_query($conn,"INSERT INTO POSTS (postID, dateTime, title, content) VALUES ('$postID', '$dateTime', '$title', '$blog')")
			or die("Query unsuccessful " . mysqli_error($conn));
	}
}
echo "<p>out of branches</p>"; //test

//query successful
header('Location: /add-entry-file.php');
// change above
$conn->close();

		//}//
	//}//
	//else{//
		//header('Location: /webroot/finalWebMini/redirect.php');//
	//}//

?>
