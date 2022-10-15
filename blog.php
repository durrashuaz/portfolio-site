<?php
    if(!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<?php
require "_head-header_2.php";
?>

<div class='bg bg--light bg--lines1'>
    <div class='section'>
        <div class='container'>
            No blog entries at the moment. Check out <a class="a" href="/portfolio.php">Portfolio entries.</a>
        </div>
    </div>
</div>

<?php require "components/_footer.php" ?>

</body>
</html>