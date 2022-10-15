<!DOCTYPE html>
<html>
<?php require 'components/_head-header.php' ?>

What thE FUCK

<?php
 if(!isset($_SESSION)) {
    session_start();
}
 echo "status: ". $_SESSION['status'];
?>

<?php require 'components/_footer.php' ?>
</body>
</html>