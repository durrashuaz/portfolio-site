<?php

//a php script that redirects the page to addPost.php if admin is logged in,
//or redirects to login.html if they are not
//gives error message if guest wants to post a blog
session_start();

	if(isset($_SESSION['status'])){ //if user already logged in
		if($_SESSION['status'] === "admin"){
		header('Location: /webroot/finalWebMini/addPost.html');
		}
		else if($_SESSION['status'] === "guest"){
		echo "<p>Only admins can post a blog. Go back to <a href='index.php'>homepage</a></p>";
		}
	}
	else{ //no one logged in
		echo "<p>You are not logged in and cannot post a blog.</p>";
		echo "<a href= 'index.php' >Go back to homepage</a>";
		echo "<p><a href='login.html'>Login</a> to post a blog (for admins only)</p>";
		echo "<p><a href='signUp.html'>Sign up</a></p>";
	}

?>
