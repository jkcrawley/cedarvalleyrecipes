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
    <script src='/script.js' defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@300&display=swap" rel="stylesheet">



</head>
<body>
<nav class='header'>
            <div class='logo'><a href='../index.php'><img src='../images/logo.png' width='100%' height='auto'/></a></div>
            <a href='#' class='toggle-button'>
                <span class='bar'></span>
                <span class='bar'></span>
                <span class='bar'></span>
            </a>
            <div class='navbar' >
                <ul>
                    <li><a href='../index.php'>HOME</a></li>

                    <li class='dropdown' data-dropdown><a href='#' class='link' data-dropdown-button>ACCOUNT</a>

<?php



if(isset($_COOKIE['user']) || isset($_SESSION['username'])){
    
?>
                    <div class='subnav'>
                        <ul>
                            <li><a href='../users/account.php?id=<?php echo $_SESSION['userid']; ?>''>My Account</a></li>
                            <li><a href='../includes/logout.php' id='logout'>Logout</a></li>
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
                            <li><a href='../register.php'>Register</a></li>
                            <li><a href='../login.php'>Login</a></li>
                        </ul>
                    </div>



<?php
}
    
?>
                    </li>

                    
                </ul>
            </div>
        </nav>
        



<div class='main-container'>
<?php




//check if form was submitted
if(isset($_POST['submit'])){

//create global error variables
$titleErr = "";
$descErr = "";
$recErr = "";
$imgErr = "";

//create criteria for file type for image upload
$extensions = array('jpg', 'jpeg', 'png', 'gif');

//extract file type from chosen file name
$file_ext = explode('.', $_FILES['imgUpload']['name']);
$file_ext = end($file_ext);

//check for errors
    if(empty($_POST['rectitle']) || empty($_POST['recdesc']) || empty($_POST['recipe']) || $_FILES['imgUpload']['name'] == '' || !in_array($file_ext, $extensions))
        {
            if(empty($_POST['rectitle'])){ 
                $titleErr = '<li><b>X</b> You must enter a title</li>';
            }
            if(empty($_POST['recdesc'])){ 
                $descErr = '<li><b>X</b> You must enter a description</li>';
            }
            if(empty($_POST['recipe'])){ 
                $recErr = '<li><b>X</b> You must enter a recipe</li>';
            }
            if($_FILES['imgUpload']['name'] == '' || !in_array($file_ext, $extensions)){
                $imgErr = '<li><b>X</b> Image is either missing or improper format</li>';
            }
//form after submissions with errors
?>

<form action='addrecipe.php' class='formstyle' name='addrecipe' method='post' enctype='multipart/form-data'>
<ul style='background-color: red; color: white;'>
<?php
echo $titleErr;
echo $descErr;
echo $recErr;
echo $imgErr;
?>
</ul>
<div class="formtable">
    <table>
    <caption><h2>Add New Recipe</h2></caption>
        <tr>
            <td valign='top' align='left'><strong>Title:</strong></td>
            <td valign='top' align='left'><input type='text' name='rectitle' /></td>
        </tr>
        <tr>
            <td valign='top' align='left'><strong>Category: </strong></td>
            <td valign='top' align='left'>
                <select name='category' id='category'>
<?php
$catSQL = "SELECT c_id, c_name from categories;";
$catResult = mysqli_query($conn, $catSQL);


while($catRows = mysqli_fetch_array($catResult)){
    $catName = ucfirst($catRows['c_name']);
?>
<option value='<?php echo $catRows['c_id']; ?>''> <?php echo $catName; ?> </option>
<?php
}

?>
                </select>
            </td>
        </tr>
        <tr>
            <td valign='top' align='left'>
                <strong>Upload Cover Image:</strong>
            </td>
            <td valign='top' align='left'>
                <input type='file' name='imgUpload' id='imgUpload' />
            </td>
        </tr>
        <tr>
            <td valign='top' align='left'><strong>Brief Description:<strong></td>
            <td align='left'><textarea name='recdesc'' rows='5'></textarea>
        </tr>
        <tr><td valign='top' colspan='2' align='left'><strong>Recipe:</strong><br />
  <textarea name='recipe' id='recipe' > 
  </textarea>
</td></tr>
<tr>
            <td valign='top' colspan='2' align='right'>
                <input type='submit' class='submitbtn' name='submit' />
            </td>
        </tr>
  </table>
</div>
</form>
</div>
<?php
        } else {

 //prepare variables for sql injection
 $imgUpload = $_FILES['imgUpload']['name'];

 $user = $_SESSION['userid'];
 $title = mysqli_real_escape_string($conn, $_POST['rectitle']);
 $category =  $_POST['category'];
 $image = mysqli_real_escape_string($conn, $_FILES['imgUpload']['name']);
 $desc = mysqli_real_escape_string($conn, $_POST['recdesc']);
 $rec = mysqli_real_escape_string($conn, $_POST['recipe']);
 $recipeInsert = "INSERT INTO recipes(r_users, r_image, r_description, r_date, r_cat, r_title, r_recipe) VALUES($user, '$image', '$desc', CURDATE(), $category, '$title', '$rec');";
 if($conn->query($recipeInsert) === TRUE){
         echo "<h2>Recipe Added!</h2>";
 } else {
     echo "Error: " . $recipeInsert . "<br />" . $conn->error;
 }



 move_uploaded_file($_FILES['imgUpload']['tmp_name'], 'userimages/' . $_FILES['imgUpload']['name']);
 $ext_error = false;





    } 
} else {
?>

<form action='addrecipe.php' class='formstyle' name='addrecipe' method='post' enctype='multipart/form-data'>
    <div class='formtable'>
    <table>
        <h2>Add New Recipe</h2>
        <tr>
            <td valign='top' align='left'><strong>Title:</strong></td>
            <td valign='top' align='left'><input type='text' name='rectitle' /></td>
        </tr>
        <tr>
            <td valign='top' align='left'><strong>Category: </strong></td>
            <td valign='top' align='left'>
                <select name='category' id='category'>
<?php
$catSQL = "SELECT c_id, c_name from categories;";
$catResult = mysqli_query($conn, $catSQL);


while($catRows = mysqli_fetch_array($catResult)){
    $catName = ucfirst($catRows['c_name']);
?>
<option value='<?php echo $catRows['c_id']; ?>'> <?php echo $catName; ?> </option>
<?php
    
}

?>
                </select>
            </td>
        </tr>
        <tr>
            <td valign='top' align='left'>
                <strong>Upload Cover Image:</strong>
            </td>
            <td valign='top' align='left'>
                <input type='file' name='imgUpload' id='imgUpload' />
            </td>
        </tr>
        <tr>
            <td valign='top' align='left' colspan='2'><strong>Brief Description:<strong></td>
        </tr>
        <tr>
            <td align='left' colspan='2'><textarea name='recdesc'' rows='5'></textarea>
        </tr>
        <tr><td valign='top' colspan='2' align='left'><strong>Recipe:</strong><br />
  <textarea name='recipe' id='recipe' > 
  </textarea>
</td></tr>
<tr>
            <td valign='top' colspan='2' align='right'>
                <input type='submit' class='submitbtn' name='submit' />
            </td>
        </tr>
  
  </table>
    </div>
</form>
</div>
<?php
}
?>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#recipe' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>

</html>