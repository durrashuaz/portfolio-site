<?php

//if(!isset($_SESSION)) { //
//	session_start();
//}
//if (isset($_SESSION['user'])){//
//	if($_SESSION['user'] === "admin"){//only admins can post blogs (incase user types in addPost URL) //

//Set server info variables
//$dbuser = "user";
//$dbhost = "10.131.23.76"; //ip address
//$dbpass = "password";
//$dbname = "ecs417";

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbuser = getenv("DATABASE_USER");
$dbpass = getenv("DATABASE_PASSWORD");
$dbname = getenv("DATABASE_NAME");

//Creates connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Checks connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Connection Success
	//generate a postID
		//select last postID from database and increment, if none, ID = 100 (to avoid confusion with primary ID)
$sql = mysqli_query($conn,"SELECT  * FROM POSTS")
	or die("Query unsuccessful " . mysqli_error($conn));

	if($sql -> num_rows > 0){  //if table has row(s)
	echo "<p>more than 0 rows</p>";
		$lastrow = mysqli_query($conn,"SELECT * FROM POSTS ORDER BY postID DESC LIMIT 1")
		or die("Query unsuccessful " . mysqli_error($conn));

			while($row = mysqli_fetch_assoc($lastrow)){
				$postID = $row['postID'] + 2;  //last postID is incremented by 2
			}
	}
	else{
		$postID = 100; //blog post IDs increment from start value of 100
	}

 //upload request is from submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "<p> request method post</p>";

	//get form data input
	$title = $_POST["title"];
	$blog = $_POST["blogText"];

	//set current time in appropriate format
	$format = 'jS F Y, G:i e';
	date_default_timezone_set('UTC');
	$dateTime = date($format);


	//insert all post information into database
	$sql = mysqli_query($conn,"INSERT INTO POSTS (postID, dateTime, title, postContent) VALUES ('$postID', '$dateTime',  '$title', '$blog')")
		or die("Query unsuccessful " . mysqli_error($conn));

}
else{ //upload is from preview upload

	session_start();

	if(isset($_SESSION['previewTitle']) && isset($_SESSION['previewBlog']) && isset($_SESSION['time'])) {
		$dateTime = $_SESSION['time'];  //depends if they want the time from the original, or when it is posted, makes sense if it is posted
		$title = $_SESSION['previewTitle'];
		$blog = $_SESSION['previewBlog'];

		//insert all post information into database
		$sql = mysqli_query($conn,"INSERT INTO POSTS (postID, dateTime, title, postContent) VALUES ('$postID', '$dateTime', '$title', '$blog')")
			or die("Query unsuccessful " . mysqli_error($conn));
	}
}
echo "<p>out of branches</p>"; //test

//query successful
header('Location: /webroot/finalWebMini/viewBlog.php');
$conn->close();

		//}//
	//}//
	//else{//
		//header('Location: /webroot/finalWebMini/redirect.php');//
	//}//

?>
