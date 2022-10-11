
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
            