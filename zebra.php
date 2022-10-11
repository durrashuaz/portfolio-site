
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
            