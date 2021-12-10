<?php
session_start();
if(isset($_SESSION['remuser'])){
    setcookie(user, $_SESSION['username'], time() + (86400 * 30), "/");
    setcookie(userid, $_SESSION['userid'], time() + (86400 * 30), "/");
    setcookie(userlevel, $_SESSION['userlevel'], time() + (86400 * 30), "/");
    }
include 'includes/head.php';

//connect to database
include 'includes/config.php';

//check if user is already logged in

if(isset($_SESSION['username'])){
    echo "<h1>You're already logged in!</h1>";
} else {
//check if login form has been submitted
if(isset($_POST['subbtn'])){
//if the form has been submitted, format input text for sql statement
    $myusername = mysqli_real_escape_string($conn, $_POST['namelog']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['passlog']);
    $remember = $_POST['remlogin'];

//compare form username to database username
    $sql = "SELECT u_id, u_username, u_password, u_level FROM users WHERE u_username ='$myusername'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

//retrieve encrypted password from table
    $hashpass = $row['u_password'];

//return number of rows found with username
    $count = mysqli_num_rows($result);

//check if row was found
    if($count == 1){

//verify password from the form with encrypted password from the users table
        if(password_verify($mypassword, $hashpass)){
           $_SESSION['username'] = $row['u_username'];
            $_SESSION['userlevel'] = $row['u_level'];
            $_SESSION['userid'] = $row['u_id'];

            $userName = $row[u_username];
            $userLevel = $row[u_level];
            $userId = $row[u_id];

            if(isset($_POST['remlogin'])){
                $_SESSION['remuser'] = $remember;
                $_SESSION['userlevel'] = $row['u_level'];
                $_SESSION['userid'] = $row['u_id'];
            }

?>

<?php
echo "<input type='hidden' id='jsUser' value='" . $userName . "' />";
?>
<script>
let userName = document.getElementById('jsUser').value;


localStorage.setItem('username', userName);

var jsUser = localStorage.getItem('username');

</script>
<?php


            echo "<h2>Welcome " . $_SESSION['username'] . "!</h2>";
?>

<p><a href='user/account.php?id=<?php echo $_SESSION['userid']; ?>'>Go to your account &#62;&#62;&#62;</a>

<?php
        } else {

//wrong password error
                echo "Password is invalid!";
                include 'includes/logform.php';
        }
    } else {

//wrong username error
        echo "That username does not exist!";
        
        include 'includes/logform.php';
        
    } 
} else {
//form before being submitted

include 'includes/logform.php';



}

}
include 'includes/footer.php';
?>