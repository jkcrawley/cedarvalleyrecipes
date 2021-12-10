<?php
session_start();
include"../includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tiny.cloud/1/8mwjrlhks2tk73ofnnb9x7guxp4ipqd7dyf3rg46nc4rmq17/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <title>Cedar Valley Recipes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/styles.css' rel='stylesheet' />
    <script src='../script.js' defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@300&display=swap" rel="stylesheet">



</head>
<body>
<nav class='navbar'>
            <div class='logo'><a href='../index.php'><img src='../images/logo.png' width='100%' height='auto'/></a></div>
            <a href='#' class='toggle-button'>
                <span class='bar'></span>
                <span class='bar'></span>
                <span class='bar'></span>
            </a>
            <div class='navbar-links' >
                <ul>
                    <li><a href='../index.php'>HOME</a></li>

                    <li class='dropdown' data-dropdown><a href='#' class='link' data-dropdown-button>ACCOUNT</a>
<?php
if(isset($_SESSION['userlevel'])){
?>
                        <ul class='dropdown-menu'>
                            <li><a href='../users/account.php?id=<?php echo $_SESSION['userid']; ?>'>My Account</a></li>
                            <li><a href='../includes/logout.php'>Logout</a></li>
                        </ul>
<?php
} else {
?>
                        <ul class='dropdown-menu'>
                            <li><a href='../register.php'>Register</a></li>
                            <li><a href='../login.php'>Login</a></li>
                        </ul>
<?php
}
?>
                    </li>

                    <li><a href='#' class='link'>BROWSE</a>
                        
                </li>
                    <li><a href='#'>ARTICLES</a></li>
                </ul>
            </div>
        </nav>
        



<div class='main-container'>
<?php
$userid = $_SESSION['userid'];

$sql = "SELECT * FROM users WHERE u_id = '$userid';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


if($row['u_level'] = '2'){
?>
<h1>Admin tools for <?php echo $row['u_username']; ?></h1>

<p><a href='editusers.php?=<?php echo $userid; ?>'>Edit Users</a></p>
<?php
} else {
?>
<p>You do not have permission to this page.</p>

<?php
}
?>
    </div>
<div class='footer'>
    <p><i>Created by James Crawley | 2021&copy;</i></p>
</div>
</body>
</html>