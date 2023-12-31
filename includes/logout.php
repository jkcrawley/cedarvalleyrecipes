<?php
session_start();
session_destroy();

if(isset($_COOKIE['user'])){
setcookie(user, $_SESSION['username'], time() -3600, "/");
setcookie(userid, $_SESSION['username'], time() -3600, "/");
setcookie(userlevel, $_SESSION['username'], time() -3600, "/");
}

header("location:../index.php");



?>

