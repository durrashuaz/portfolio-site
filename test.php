<!DOCTYPE html>
<html>
<?php require 'components/_head-header.php' ?>


<?php
 if(!isset($_SESSION)) {
    session_start();
}
 echo "status: ". $_SESSION['status'];
?>
<?php require 'components/_footer.php' ?>
</body>
</html>