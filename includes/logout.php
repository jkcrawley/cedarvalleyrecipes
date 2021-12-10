<?php
session_start();
session_destroy();
setcookie(user, $_SESSION['username'], time() -3600, "/");
header("location:http://jkcrawley.com/cedarvalleyrecipes/index.php");


?>

