<?php

include '../includes/connect.php';
session_start();

//get form input from user
$username = $_POST["username"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$userStatus = "guest"; //indicates new account is a guest

	//connection successful
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//query: get existing user info in database
	$sql = mysqli_query($conn,'SELECT * FROM userlog')
		or die("Query unsuccessful " . mysqli_error($conn));

		$credentialsExist = false;

		if( $sql -> num_rows > 0 ){  //if table has row(s)
		while( $rows = mysqli_fetch_assoc( $sql ) ){
			if( $credentialsExist == false ){

				if($username === $rows['username']){ //username already exists in database
					//if($username === $rows['username']){
					echo "<p> Username taken. Try another username. </p>";
					$credentialsExist = true;
					$_SESSION['usernameExist'] = "Username taken. Try another username.";
					//header('Location: /signUp.php');
				}
				if($email === $rows['email']){ //email already exists in database
					echo "<p> Email is already used. You already have an account. </p>";
					$credentialsExist = true;
					$_SESSION['emailExist'] = "Email is already used. You already have an account.";
				}
				else{ //FIX THIS; this lets users sign up with credentials that exist AFTER the first row. this branch only checks first row first to satisfy credentials that son't exist and immerdiately adds account to table

					//insert sign up info into userlog table
					$sql = mysqli_query($conn,"INSERT INTO userlog (user, username, name, email, password) VALUES ('$userStatus', '$username', '$name', '$email', '$password')")
					or die("Query unsuccessful " . mysqli_error());
					//automatic login

					$_SESSION["name"] = $name; //store their name
					$_SESSION["username"] = $username; //store their username
					$_SESSION['status'] = $userStatus; //status of user indicated
					
					$loginUnsuccessful = false;
					//user signed up and logged in
					header('Location: /');
				}
			}
		}
	}

$conn->close();

}

?>
