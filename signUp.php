<?php

//get form input from user
$username = $_POST["username"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$userStatus = "guest"; //indicates new account is a guest

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

	//connection successful
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//query: get existing user info in database
$sql = mysqli_query($conn,'SELECT * FROM USERLOG')
	or die("Query unsuccessful " . mysqli_error($conn));

	//query successful
	//check if credientials don't already exist, error message if it does
		//$row = mysqli_fetch_array($sql);

	$credentialsExist = false;
	if($sql -> num_rows > 0){  //if table has row(s)
		while($rows = mysqli_fetch_assoc($sql)){
			if($credentialsExist == false){

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
					echo " got into else";
					//insert sign up info into USERLOG table
					$sql = mysqli_query($conn,"INSERT INTO USERLOG (user, username, name, email, password) VALUES ('$userStatus', '$username', '$name', '$email', '$password')")
					or die("Query unsuccessful " . mysqli_error());
					//query successful
					header('Location: /webroot/finalWebMini/index.php');
				}
			}
		}
	}

$conn->close();
}

?>
