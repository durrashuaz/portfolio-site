<?php

include 'includes/connect.php';

//get user info from form
$email = $_POST["email"];
$password = $_POST["password"];

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	$sql = mysqli_query( $conn,"SELECT * FROM userlog" )
		or die( "Query unsuccessful " . mysql_error() );

	$loginUnsuccessful = false;
	echo $email; echo $password;

	//query successful
	if( $sql-> num_rows > 0 ){
		echo "test1";
		while( $rows = mysqli_fetch_assoc( $sql ) ){
			echo "Test";
			if( $email === $rows['email'] && $password === $rows['password'] ){ //login matches data

				$loginUnsuccessful = false;
				session_start();

				$_SESSION["name"] = $rows['name']; //store their name
				$_SESSION["username"] = $rows['username']; //store their username
				
				echo $_SESSION["name"];

				if( $rows['user'] === "guest" ){ //guest logs in
					$_SESSION["status"] = "guest"; //status of user indicated
					// header('Location: /webroot/finalWebMini/redirect.php');
					echo "admin";
				}
				else if( $rows['user'] === "admin" ){
					$_SESSION["status"] = "admin";
					echo "admin";
					// header('Location: /webroot/finalWebMini/addPost.html');
				}
				echo $_SESSION["status"];
				//header('Location: /index.php');
			}
			else{
				$loginUnsuccessful = true;
			}
		}
	}
	if ( $loginUnsuccessful ){
		echo "<p> Login Unsuccessful. <a href='javascript:history.back()'>Try again</a> or go back to <a href='/'>Homepage</a>.</p>";
	}

	$conn->close();
}

?>