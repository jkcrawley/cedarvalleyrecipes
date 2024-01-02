<?php
include 'includes/config.php';


?>

<!DOCTYPE>
<head>
    <title>Cedar Valley Recipes</title>
    <link href='css/styles.css' rel='stylesheet' />
    <link href='css/stylesalt.scss' rel='stylesheet' />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src='script.js' defer></script>
    <script src="https://use.fontawesome.com/16f9311a42.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

<!-- styles for other directories -->
    <link href='../css/styles.css' rel='stylesheet' />
    <link href='../css/stylesalt.scss' rel='stylesheet' />

<!-- links to fonts that are used -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@300&display=swap" rel="stylesheet">
    
</style>
</head>
<body>


<nav class='header'>
            <div class='logo'><a href='index.php'><img src='./images/logo.png' width='100%' height='auto'/></a></div>
            <a href='#' class='toggle-button'>
                <span class='bar'></span>
                <span class='bar'></span>
                <span class='bar'></span>
            </a>
            <div class='navbar' >
                <ul>
                    <li><a href='index.php'>HOME</a></li>

                    <li class='dropdown' data-dropdown><a href='#' class='link' data-dropdown-button>ACCOUNT</a>

<?php



if(isset($_COOKIE['user']) || isset($_SESSION['username'])){
    
?>
                    <div class='subnav'>
                        <ul>
                            <li><a href='users/account.php?id=<?php echo $_SESSION['userid']; ?>''>My Account</a></li>
                            <li><a href='includes/logout.php' id='logout'>Logout</a></li>
                        </ul>
                    </div>

<!--Clear local storage when logging out -->
<script>
const logOut = document.getElementById('logout');

function clearStorage(){
 localStorage.removeItem('username');
}

logOut.addEventListener('click', clearStorage);
</script>

<?php
} else {
   
?>
                    <div class='subnav'>
                        <ul>
                            <li><a href='register.php'>Register</a></li>
                            <li><a href='login.php'>Login</a></li>
                        </ul>
                    </div>



<?php
}
    
?>
                    </li>

</div>  
                </li>
                </ul>
            </div>
        </nav>
        




    </div>
    <div class='main-container'>