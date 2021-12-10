<?php
session_start();
include"../includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tiny.cloud/1/8mwjrlhks2tk73ofnnb9x7guxp4ipqd7dyf3rg46nc4rmq17/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <title>Cedar Valley Recipes</title>
    <link href='../css/styles.css' rel='stylesheet' />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Poppins:wght@300&display=swap" rel="stylesheet">

<?php

//uploading image

//create criteria for file type
$extensions = array('jpg', 'jpeg', 'png', 'gif');

//extract file type from chosen file name
$file_ext = explode('.', $_FILES['imgUpload']['name']);
$file_ext = end($file_ext);

//generate error if file extension doesn't match extension criteria
if(!in_array($file_ext, $extensions)){
    $imgerror = 'Images must be either .jpg, .gif, .png, or .jpeg';
} else{

//uploaded image if extension meets criteria
    if(isset($_FILES['imgUpload'])){
        move_uploaded_file($_FILES['imgUpload']['tmp_name'], 'userimages/' . $_FILES['imgUpload']['name']);
        $ext_error = false;
    }
}
?>

</head>
<body>
<div class='header'>

<div class='logo'><a href='../index.php'><img src='../images/logo.png' /></a></div>

<div class='usernav'>
<?php
if(isset($_SESSION['userlevel'])){
?>
    <p><a href='account.php'>My Account</a> | <a href='../includes/logout.php' class='submitbtn'>Logout</a></p>
<?php
} else {
?>
    <p><a href='register.php'>Sign up</a> or <a href='login.php'>Log in</a></p>
<?php
}
?>
</div>

<div class='navigation'>
    <ul>
        <li><a href='http://jkcrawley.com/cedarvalleyrecipes/index.php'>Home</a> | </li>
        <li><a href='#'>Browse</a> | </li>
        <li><a href='#'>Articles</a></li>
    </ul>
</div>


</div>
<div class='main-container'>
<?php
echo $imgerror;
?>

<form action='addrecipe.php' class='formstyle' name='addrecipe' method='post' enctype='multipart/form-data'>
    <table>
    <caption><h2>Add New Recipe</h2></caption>
        <tr>
            <td><strong>Title:</strong></td>
            <td><input type='text' name='rectitle' /></td>
        </tr>
        <tr>
            <td><strong>Category: </strong></td>
            <td>
                <select name='category' id='category'>
<?php
$catSQL = "SELECT c_id, c_name from categories;";
$catResult = mysqli_query($conn, $catSQL);


while($catRows = mysqli_fetch_array($catResult)){
    $catName = ucfirst($catRows['c_name']);
?>
<option value='<?php echo $catRows['c_id']; ?>''> <?php echo $catName; ?> </option>
<?php
    $i++;
}

?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Upload Cover Image:</strong>
            </td>
            <td>
                <input type='file' name='imgUpload' id='imgUpload' />
            </td>
        </tr>
        <tr><td colspan='2'>
  <textarea id='description' style='width:500px'>
    Welcome to TinyMCE!
  </textarea>
</td></tr>
<tr>
            <td colspan='2' align='right'>
                <input type='submit' class='submitbtn' />
            </td>
        </tr>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>
  </table>

</form>
</div>
</body>
</html>