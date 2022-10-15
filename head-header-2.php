<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<head lang="en">
   <meta charset="utf-8">
   <title>Durra Shuazlan</title>
   <link rel="stylesheet" href="../stylesheets/final/main.css"/>
   <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap');</style>
   <style>@import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap');</style>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
if(!isset($_SESSION)) {
    session_start();
}


include 'includes/connect.php'; //if file in no specific folder

$uri_path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$uri_segments = explode( '/', $uri_path );
$url_segment_1 = $uri_segments[1];
$url_segment_2 = $uri_segments[2];

if(isset($url_segment_1)){
    echo $url_segment_1;
}
if(isset($url_segment_1)){
    echo $url_segment_2;
}

if( $url_segment_1 === "index.php" || $url_segment_1 === "" ){
    echo "<div class='bg bg--featured bg--lines1'>";
} else {
    echo "<div class='bg bg--light bg--lines1'>";
}

?>
    <header class="nav">
        <nav class="nav__inner">
            <a href="/"><img class="nav__logo" src="../images/logo.png" alt="logo" width="150" height="80"></a>
            <div class="nav__links a5-12">
                <ul class="nav__primary flex">
                    <li><a href="~/../portfolio.php">Portfolio</a></li>
                    <li><a href="~/../blog.php">Blog</a></li>
                </ul>
                <!-- <ul class="nav__secondary flex">
                    <li><a href="">About</a></li>
                    <li><a href="">Featured Work</a></li>
                </ul> -->
            </div>
            <div class="nav__login-burger a6-12">
                <div class="nav__login grid">
                    <?php
                        if(!isset($_SESSION)) {
                            session_start();
                        }
                        //
                        echo "status: ". $_SESSION['status'];
                        echo "";
                        echo " name:" . $_SESSION["name"];
                        //
                        if(isset($_SESSION['status'])){ ?>
                            <div class="flex flex--column">
                            <?php
                                echo "Welcome back " . $_SESSION["name"] . "!";
                                echo "<a href='logout.php'>Logout</a></li>";
                                ?>
                            </div>
                        <?php
                        }
                        else{
                            echo "<button class='nav__signUp__open grid__item'>Sign Up<span class='icon-user-plus'></span></button>";
                            echo "<button class='nav__login__open grid__item'>Login<span class='icon-enter'></span></button>";
                        }
                    ?>
                </div>
                <button class="nav__burger">
                    <span class="icon-menu"></span>
                    <span class="icon-cross"></span>
                </button>
            </div>
        </nav>
        <div class="nav__mobile">
            <img src="../images/navBg.png" alt="logo" width="100%" height="100%">
            <a href="~/../portfolio.php" class="nav__mobile__link nav__mobile__link--portfolio">Portfolio</a>
            <a href="~/../blog.php" class="nav__mobile__link nav__mobile__link--blog">Blog</a>
            <div class="nav__mobile__footer grid grid--m flex">
                <ul class="grid__item">
                    <li><a href="https://www.linkedin.com/in/durra-shuazlan-57b688195/?originalSubdomain=uk" target="_blank">
                        View my CV
                    </a></li>
                    <li><a href="tel:+447307479096">+44(0)7307479096</a></li>
                    <li><a href="mailto:durrao.brien@gmail.com">durrao.brien@gmail.com</a></li>
                    <li><a href="https://www.linkedin.com/in/durra-shuazlan-57b688195/?originalSubdomain=uk" target="_blank">LinkedIn</a></li>
                    <li><a href="https://github.com/durrashuaz" target="_blank">GitHub</a></li>
                </ul>
            </div>
        </div>
    </header>


<?php
    include '_login.html';
    include '_signUp.html';
?>