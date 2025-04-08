<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "auction";

    $conn = mysqli_connect($server,$username,$password,$database);
    if($conn){
        // echo "sucess";
    }
    else{
        die("error".mysqli_connect_error());
    }
?>