<?php
    if(!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <title>Durra Shuazlan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta property="og:image" content="https://durrashuazlan.com/images/logo.png" />
   <meta name="og:description" content="Durra Shuazlan's portfolio website consisting of project and blog entries.">
   <link rel="stylesheet" href="../stylesheets/final/main.css"/>
   <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap');</style>
   <!-- <style>@import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap');</style> -->
</head>
<body>

<?php

if( isset( $url_segment_2 ) ){
    include '../includes/connect.php'; //if file inside another folder
}
else {
    include 'includes/connect.php'; //if file in no specific folder
}

$uri_path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$uri_segments = explode( '/', $uri_path );
$first_url_segment = $uri_segments[1];

if( $first_url_segment === "index.php" || $first_url_segment === "" ) {
    echo "<div class='bg bg--light'>";
} else {
    echo "<div class='bg bg--featured'>";
}

?>
    <header class="nav">
        <nav class="nav__inner">
            <a href="/"><img class="nav__logo" src="../images/logo.png" alt="logo" width="141" height="76"></a>
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
                        if(isset($_SESSION['status'])){ ?>
                            <div class="nav__message flex flex--column">
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
                    <li><a href="mailto:contact@durrashuazlan.com">contact@durrashuazlan.com</a></li>
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

<script type="application/ld+json">
    {"@context" : "http://schema.org",
    "@type" : "Computer Scientist", 
    "name" : "Durra Shuazlan",
    "url" : "https://www.durrashuazlan.com",
    "logo": "https://durrashuazlan.com/images/logo.png" }
</script>
