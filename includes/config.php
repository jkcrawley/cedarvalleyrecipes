<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cvrecipes";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if(mysqli_connect_error()){
    die("database connection failed: " . mysqli_connect_error());
} 



?>