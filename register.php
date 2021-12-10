<?php
session_start();
include 'includes/head.php';

//connect to database
include 'includes/config.php';


//check if form has been submitted
if(isset($_POST['fsubmit'])){



//putting form fields into variables
$username = $_POST['regname'];
$password = $_POST['regpass'];
$conpassword = $_POST['regcon'];
$newsletter = $_POST['newsletter'];
$email = $_POST['email'];
$lvlrequest = $_POST['lvlrequest'];

//check to see if user already exists
    $checkusersql = "SELECT u_username FROM users WHERE u_username ='$username'";
    $userresult = mysqli_query($conn, $checkusersql);
    $userrow = mysqli_fetch_array($userresult,MYSQLI_ASSOC);

//validating form
    if($username == $userrow['u_username'] || empty($username)|| empty($password) || $password != $conpassword){
        if($username == $userrow['u_username']){
            $checkuser = "<li>Username already exists</li>";
        }

        //if user did not enter a user name
        if(empty($username)){
            $usererr = "<li>You did not enter a user name.</li>";
        }

        //if user did not enter password
        if(empty($password)){
            $passerr = "<li>You did not enter a password.</li>";
        }

        //if user did not confirm password
        if($password != $conpassword){
            $conerr = "<li>Passwords do not match.</li>";
        }

        
?>
<!-- form with errors displayed -->


<form action="register.php" method="post">
        
    <div class='formstyle'>
    <ul class='formerror'>

<?php
//display errors
echo $checkuser;
echo $usererr;
echo $passerr;
echo $conerr;
?>
</ul>

        <div class='formbox'>
            <strong>Username:</strong><br />
            <input type='text' name='regname' id='uname' />
        </div>

        <div class='formbox'>
            <strong>Password:</strong><br />
            <input type='password' name='regpass' />
        </div>

        <div class='formbox'>
            <strong>Confirm Password:</strong><br />
            <input type='password' name='regcon' />
        </div>

        <div class='formbox'>
            <label for='newsletter'><strong>Would you like to recieve a newsletter?</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='newsletter' value='yes' id='newsyes' onclick='emailDis(0);' /><span id='newsyes'><label for='newsyes'> Yes</label></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='newsletter' id='newsno' value='no' onclick='emailDis(1);' checked/><label for='newsno'> No</label>
        </div>

        
           <div id='email'> <label for='email' ><strong>Email:</strong><br />
           <p id='emailIn'></p> 
            </div>

        <div class='formbox'>
            <label for='lvlrequest'><strong>Would you like to contribute recipes and articles to Cedar Valley Racipes?</strong></label><br />
            <input type='radio' name='lvlrequest' id='reqyes' value='yes' /><label for='reqyes'>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='lvlrequest' id='reqno' value='no' checked/><label for='reqno'>No</label>
        </div>

        <div class='formbox'>
            <input type='submit' name='fsubmit' id='test' class='submitbtn' value='Sign up!'/>
        </div>

<?php

    } else {
//registering user information into database. Start by converting input text to be put into database

        $sqluser = mysqli_real_escape_string($conn, $_POST['regname']);
        $sqlpass = mysqli_real_escape_string($conn, $_POST['regpass']);

//hash password for security
        $hashpass = password_hash($sqlpass, PASSWORD_BCRYPT);

//insert new user's info into database
        $insertSQL = "INSERT INTO users(u_username, u_password, u_level, u_email, u_lvlrequest, u_newsletter) VALUES('$sqluser','$hashpass', '0', '$email', '$lvlrequest', '$newsletter');";
        if($conn->query($insertSQL) === TRUE){
            $_SESSION['username'] = $sqluser;

//automatic log in
            $sqlLog = "SELECT * users WHERE u_username = '" . $sqluser . "';";
            $logRes = mysqli_query($conn, $sqlLog);
            $logRow = mysqli_fetch_array($logRes, MYSQLI_ASSOC);
            $logNum = mysqli_num_rows($logRes);

        if($logNum == 1){
            $_SESSION['userid'] = $logRow['u_id'];
            $_SESSION['userlevel'] = $logRow['u_level'];
            echo "There's a user id of " . $logRow['u_id'];
        }


            echo "<h2>Welcome " . $_SESSION['username'] . "!</h2>";
?>
<p><a href='login.php'>Login &#62;&#62;&#62;</a></p>
<?php
            
        } else {
            echo "Error: " . $insertSQL . "<br />" . $conn->error;
        }
    }

} else {
?>

<form action="register.php" method="post">
        
    <div class='formstyle'>
        

        <div class='formbox'>
            <strong>Username:</strong><br />
            <input type='text' name='regname' id='uname' required/>
        </div>

        <div class='formbox'>
            <strong>Password:</strong><br />
            <input type='password' name='regpass' required/>
        </div>

        <div class='formbox'>
            <strong>Confirm Password:</strong><br />
            <input type='password' name='regcon' required/>
        </div>

        <div class='formbox'>
            <label for='newsletter'><strong>Would you like to recieve a newsletter?</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='newsletter' value='yes' id='newsyes' onclick='emailDis(0);' /><span id='newsyes'><label for='newsyes'> Yes</label></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='newsletter' id='newsno' value='no' onclick='emailDis(1);' checked/><label for='newsno'> No</label>
        </div>

        
           <div id='email'> <label for='email'><strong>Email:</strong><br />
            <span id='emailIn'></span>
            </div>

        <div class='formbox'>
            <label for='lvlrequest'><strong>Would you like to contribute recipes and articles to Cedar Valley Racipes?</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;<br />
            <input type='radio' name='lvlrequest' id='reqyes' value='yes' /><label for='reqyes'>Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='radio' name='lvlrequest' id='reqno' value='no' checked/><label for='reqno'>No</label>
        </div>

        <div class='formbox'>
            <input type='submit' name='fsubmit' id='test' class='submitbtn' value='Sign up!'/>
        </div>

        
        
        
        
        
    
        
        
        

    </div>
</form>

<?php
}
include 'includes/footer.php';
?>