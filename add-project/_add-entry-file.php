<?php
include '../includes/connect.php';
session_start();

$posts = mysqli_query( $conn, "SELECT * FROM projects ORDER BY ID DESC LIMIT 1" )
or die( "Query unsuccessful sdfsdf" . mysqli_error( $conn ) );

if( $posts -> num_rows > 0 ){
    echo "more than one row : : ";
    while( $rows = mysqli_fetch_assoc( $posts ) ){
        echo $rows['title'] . $rows['id'] . "testing";
        $project_title = $rows['title'];
        $project_title = str_replace( " ", "-", $project_title );
        $myfile = fopen( "../" . "$project_title" . ".php", "x+" ) or die( "Unable to open file!" );

        $text = '<?php include "_project-entry-structure.php"; ?>';

        fwrite( $myfile, $text );
        fclose( $myfile );
    }

}

header('Location: /"$project_title" . ".php"');

?>