<?php

include '../includes/connect.php';
session_start();

//if(!isset($_SESSION)) { //
//	session_start();
//}
//if (isset($_SESSION['user'])){//
//	if($_SESSION['user'] === "admin"){//only admins can post blogs (incase user types in addPost URL) //

//upload request is from submit form
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	//get form data input
	$title = $_POST["title"];
	$title = $_POST["link"];
	$subtitle = $_POST["subtitle"];
	$organisation = $_POST["organisation"];
	$content = $_POST["projectText"];

	//set current time in appropriate format
	date_default_timezone_set('GMT');
	$dateTime = date("Y-m-d");

	//generate a postID
	$sql = mysqli_query( $conn, "SELECT  * FROM projects" )
		or die( "Query unsuccessful " . mysqli_error( $conn ) );

	if( $sql -> num_rows > 0 ){
		echo "<p>more than 0 rows</p>";
		$lastrow = mysqli_query( $conn,"SELECT * FROM projects ORDER BY id DESC LIMIT 1" )
		or die( "Query unsuccessful " . mysqli_error( $conn ) );

		while( $row = mysqli_fetch_assoc( $lastrow ) ){
			echo "the id is " . $row["id"] . "| ";
			$id =  $row['id'] + 1;  //last postID is incremented by 1
			echo "the id + 1 is" . $id . "fuck";
		}
	} else {
		$id = 0;
	}
	//echo $id . "title and shit is:" . $title . "subtitle:". $subtitle . "content" . $content;
	//insert all post information into database

	$sql = mysqli_query( $conn, "INSERT INTO projects ( id, dateTime, title, link, subtitle, organisation, content ) VALUES ( '$id', '$dateTime',  '$title',  '$link', '$subtitle', '$organisation', '$content' )" )
		or die( "Query unsuccessful " . mysqli_error( $conn ) );

	//Add images for post
	$target_dir = "../images/project-images/";
	$target_file = $target_dir . basename( $_FILES["fileToUpload"]["name"] );
	echo $target_file;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if( $check !== false ) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}

	// Check if file already exists
	// if ( file_exists( $target_file ) ) {
	// 	echo "Sorry, file already exists.";
	// 	$uploadOk = 0;
	// }

	// Check file size
	// if ( $_FILES["fileToUpload"]["size"] > 500000 ) {
	// 	echo "Sorry, your file is too large.";
	// 	$uploadOk = 0;
	// }

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if ( move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $target_file ) ) {
			echo "uploading";
			echo $target_file . $id;
			$sql = mysqli_query( $conn, "INSERT INTO images ( img_dir, projectId ) VALUES ( '$target_file', '$id' )" )
			or die("Query unsuccessful " . mysqli_error($conn));

			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}

	//end add images
}


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
header('Location: /add-project/_add-entry-file.php');
// change above
$conn->close();

		//}//
	//}//
	//else{//
		//header('Location: /webroot/finalWebMini/redirect.php');//
	//}//

?>
