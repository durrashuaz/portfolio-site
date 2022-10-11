<?php
    include 'connect.php';

    $posts = mysqli_query( $conn, "SELECT * FROM projects ORDER BY ID DESC LIMIT 1" )
	or die( "Query unsuccessful sdfsdf" . mysqli_error( $conn ) );

    if( $posts -> num_rows > 0 ){  //if table has row(s)
        echo "more than one row : : ";
        while( $rows = mysqli_fetch_assoc( $posts ) ){
           
           
            echo  "tdurra 1237";


            echo $rows['title'] . $rows['id'] . "testing";
			$project_title = $rows['title'];
            $project_title = str_replace( " ", "-", $project_title );
            $myfile = fopen( "$project_title" . ".php", "x+" ) or die( "Unable to open file!" );

            $text = '
            <!DOCTYPE html>
            <html>
            <?php
            require "components/_head-header.php";
            include "connect.php";
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

            ';

            fwrite( $myfile, $text );
            fclose( $myfile );
        }

    }

?>