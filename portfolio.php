<?php require 'components/_head-header.php'?>

<div class='bg bg--light'>
    <div class='section section--fh'>
        <div class='container'>
            <h1 class="h1 mb-40">Projects</h1>
            <div class="listing">
            <?php
                $posts = mysqli_query( $conn, "SELECT * FROM projects" )
                or die( "Query unsuccessful" . mysqli_error( $conn ) );

                $width="a4-12 d3-6";

                if( $posts -> num_rows > 0 ){
                    echo "<table class='x8-12 a12-12'>
                        <tr>
                            <th class=" . $width . ">Project</th>
                            <th class=" . $width . ">Organisation</th>
                            <th class=" . $width . ">Date</th>
                        </tr>";

                        while( $rows = mysqli_fetch_assoc( $posts ) ){
                            $title_path = str_replace( " ", "-", $rows["title"] );
                            $title_path = strtolower( $title_path ) . ".php";
                            if( file_exists( $title_path ) ) { //if post in db can be found in files
                                echo
                                "<tr>
                                    <td><a href=" . $title_path . ">" . $rows['title'] . "</a></td>
                                    <td>" . $rows['organisation'] . "</td>
                                    <td>" . $rows['date'] . "</td>
                                </tr>";
                            }
                        }
                    echo "</table>";
                    echo "<p>More entries coming soon!</p>";
                }
            ?>
            </div>
        </div>
    </div>
</div>

<?php require "components/_footer.php" ?>

</body>
</html>