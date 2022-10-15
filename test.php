<?php
 if(!isset($_SESSION)) {
    session_start();
}
 echo "status: ". $_SESSION['status'];
?>