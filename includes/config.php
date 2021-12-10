<?php
$servername = "db5005181242.hosting-data.io";
$username = "dbu18576";
$password = "3kjG#@1!8sIy";
$dbname = "dbs4333272";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if(mysqli_connect_error()){
    die("database connection failed: " . mysqli_connect_error());
} 



?>