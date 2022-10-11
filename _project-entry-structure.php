<!DOCTYPE html>
<html>
<?php
require "components/_head-header.php";
include 'connect.php';
session_start();

$uriSegments = explode( "/", parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH ) );
$lastUriSegment = array_pop( $uriSegments );
$title = str_replace( "-", " ", $lastUriSegment );
$title = str_replace( ".php", "", $title );

$posts = mysqli_query( $conn, "SELECT  * FROM projects" )
or die( "Query unsuccessful sdfsdf" . mysqli_error( $conn ) );

$comments = mysqli_query( $conn, "SELECT * FROM comments ORDER BY dateTime DESC" )
or die( "Query unsuccessful " . mysqli_error( $conn ) );

if( $posts -> num_rows > 0 ){
    while( $rows = mysqli_fetch_assoc( $posts ) ){
        if( strcasecmp( $rows["title"], $title ) == 0 ) {
            $id = $rows["id"];
            $title = $rows["title"];
            $subtitle = $rows["subtitle"];
            $content = $rows["content"];
            echo "
            <div class='bg bg--light bg--lines1'>
                <div class='section'>
                    <div class='container'>
                        <div class='flex flex--justify-space-between flex--wrap'>
                            <div class='post flex flex--column a8-12 d7-12 e12-12'>
                                <h1 class=''>" . $title . "</h1>
                                <h2 class=''>" . $subtitle . "</h2>
                                <div class='a8-12 c5-6 d12-12 e10-12 h6-6'>" . $content . "</div>
                            </div>
                            <button class='chat-symbol__section a4-12 e5-12 g3-6 h5-6'>
                                <figure class='chat-symbol__figure x5-12 a10-12 b12-12'>
                                    <img class='chat-symbol__img' src='images/chatShape.png' alt='chat' width='' height=''>
                                    <p class='chat-symbol__count'>4</p>
                                </figure>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='bg bg--comments'>
                <div class='section'>
                    <div class='container'>
                        <div class='comments a5-12 e8-12 h6-6'>
                        ";
                            if( $comments-> num_rows > 0 ){
                                while( $commentRows = mysqli_fetch_assoc( $comments ) ){
                                    if( $rows["id"] === $commentRows["postId"] ){//post ID on comment and post matches
                                        //Print comments
                                        echo "
                                        <div class='comments__item'>
                                            <div class='flex flex--wrap flex--justify-space-between'>
                                            <p class='comments__item__username'>". $commentRows['username'] . "</p>
                                            <p class='comments__item__time'>" . $commentRows['dateTime'] . "</p>
                                            </div>
                                            <p class='comments__item__comment'>" . $commentRows['comment'] . "</p>
                                        ";
                                        //Delete comment button (admin)
                                        $commentID= $commentRows["id"];
                                        if(!isset($_SESSION)) {
                                            session_start();
                                        }
                                        if( isset( $_SESSION["status"] ) ){
                                            if( $_SESSION["status"] === "admin" ){
                                                echo "<form class='comments__item__delete-button' method='POST' action='delete.php' class='deleteCommentForm'>
                                                <input type='hidden' name='commentID' value='$commentID'/>
                                                <input type='submit' class='deleteButton' value='Delete comment'>
                                                </form>
                                        </div>";
                                            }
                                        }
                                    }
                                }
                            }
                            $signedIn = "no";
                            if( !isset( $_SESSION ) ) {
                                session_start();
                            }
                            if( isset( $_SESSION["status"] ) ){ //store username in session variable to allow easier usage in comment form
                                $usernameComment = $_SESSION["username"];
                                $signedIn = "yes";
                            }
                        echo "</div>
                        <div class='commentSection'>
                            <form method='POST' action='addComment.php' class='commentForm a5-12 e8-12 h6-6' id='commentForm'>
                                <input type='hidden' name='postID' value='$id'/>
                                <input type='hidden' name='username' value='$usernameComment'/>
                                <textarea rows=3 class='commentTextArea' id='commentTextArea' name='commentText' placeholder='Leave a comment...' required></textarea>
                                <input class='button' id='commentButton' value='Comment' type='submit'>
                            </form>
                        </div>
                    </div>
                </div>
             </div>";
        }
    }
} ?>

<?php require "components/_footer.html" ?>

</body>
</html>

<script type="text/javascript">
    window.onload = function(){
        var signedIn = "$signedIn";
        var form = document.getElementsByClassName( "commentForm" );
        for ( var i = 0; i < form.length; i++ ) {
            form[i].addEventListener( "submit", commentHandler );
        }
        function commentHandler( event ){
            if( signedIn === "no" ){
                var confirm = window.confirm( "You are not signed in. Do you wish to login?" );
                event.preventDefault();
                if( confirm ){
                    window.location = "/webroot/finalWebMini/login.html";
                }
            }
        }
    }
</script>