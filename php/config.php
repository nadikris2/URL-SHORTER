<?php
    $conn=mysqli_connect("localhost","root","","urlshortener");
    if($conn){
        echo "Database connected";
    }
    else {
        echo "Failed";
    }

?>


