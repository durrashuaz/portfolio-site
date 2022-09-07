<?php

session_start(); //to gain access to global session variables
session_destroy();  //destroy the global variables and end session

header('Location: /webroot/finalWebMini/index.php');
?>
