<?php

//get user info from form
$email = $_POST["email"];
$password = $_POST["password"];
	//set user status variables
$guest = "guest";
$admin = "admin";


//Form connection with database
$dbhost = "localhost:3306";
$dbuser = "durrashu_admin";
$dbpass = "Deeznuts42069@";
$dbname = "durrashu_portfolio";

///Creates connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Checks connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$sql = mysqli_query($conn,"SELECT * FROM userlog")
	or die("Query unsuccessful " . mysql_error());
$loginUnsuccessful = false;
	//query successful

		while($rows = mysqli_fetch_assoc($sql)){

			if($email === $rows['email'] && $password === $rows['password']){ //login matches data

				$loginUnsuccessful = false;
				session_start();
				$_SESSION["name"] = $rows['name']; //store their name
				$_SESSION["username"] = $rows['username']; //store their username

				if($guest === $rows['user']){ //guest logs in
					$_SESSION["status"] = "guest"; //status of user indicated
					header('Location: /webroot/finalWebMini/redirect.php');
				}
				else if($admin === $rows['user']){
					$_SESSION["status"] = "admin";
					header('Location: /webroot/finalWebMini/addPost.html');
				}

				//header('Location: /index.php');
			}
			else{
				$loginUnsuccessful = true;
				//sign up message
			}
		}
		if ($loginUnsuccessful){
			echo "<p> Login Unsuccessful. <a href='javascript:history.back()'>Try again</a> or go back to <a href='index.php'>Homepage</a>.</p>";
		}

$conn->close();
}

?>
