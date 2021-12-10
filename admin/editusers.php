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
                            <li><a href='account.php?id=<?php echo $_SESSION['userid']; ?>'>My Account</a></li>
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

<table>
<tr>
    <td align='left'></td>
    <td style='padding: 0 15px; text-align: center;'><strong>Username</strong></td>
    <td style='padding: 0 15px; text-align: center;'><strong>Rank</strong></td>
    <td style='padding: 0 15px;text-align: center;'><strong>Number of Recipes</strong></td>
    <td style='padding: 0 15px;text-align: center;'><strong>Number of Articles</strong></td>
</tr>
<?php
$usersql = "SELECT u_id as 'userid', u_username as 'username', u_level as 'userlevel', COUNT(DISTINCT(r_id)) as 'recipes', IFNULL(COUNT(DISTINCT(a_id)), '0') as 'articles', l_rank as 'rank' FROM users u LEFT JOIN recipes r ON u.u_id = r.r_users LEFT JOIN articles a ON u.u_id = a.a_users LEFT JOIN levels l ON u.u_level = l.l_id GROUP BY u.u_id";
$userres = mysqli_query($conn, $usersql);

while($userrow = mysqli_fetch_array($userres)){
    
 
?>
<tr>
    <td align='left'><a href='updateuser.php?id=<?php echo $userrow['userid'];?>'>Edit</a></td>
    <td style='padding: 0 15px;text-align: center;'><?php echo $userrow['username']; ?></td>
    <td style='padding: 0 15px;text-align: center;'><?php echo $userrow['rank']; ?></td>
    <td style='padding: 0 15px;text-align: center;'><?php echo $userrow['recipes']; ?></td>
    <td style='padding: 0 15px;text-align: center;'><?php echo $userrow['articles']; ?></td>
</tr>
<?php
}
?>
</table>


    </div>
<div class='footer'>
    <p><i>Created by James Crawley | 2021&copy;</i></p>
</div>
</body>
</html>