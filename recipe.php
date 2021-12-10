<?php
include 'includes/head.php';
include 'includes/config.php';

$addId = $_GET['id'];
$recipesql = "SELECT * FROM recipes, users WHERE r_id =$addId AND recipes.r_users = users.u_id;";
$recipeRes = mysqli_query($conn, $recipesql);
$recipeRow = mysqli_fetch_array($recipeRes, MYSQLI_ASSOC);


?>
<div style="background-image: url('users/userimages/<?php echo $recipeRow['r_image']; ?>'); background-size: cover; width: 100%; padding: 0px; text-align: center; opacity: .75;">
    <div style='width: 100%; margin-top: 70px; display: block; clear: right;'>
<?php

echo "<h1 style='margin: 0px 0px 0px 0px; text-align: left; width: 100%; background-color: white;border-top: 5px solid #D2b48c; margin-top: 0px;'>&nbsp;&nbsp;&nbsp;&nbsp;" . $recipeRow['r_title'] . "</h2>";
echo "<h4 style='margin: 0px 0px 20px 0px; font-style: italic; text-align: left; background-color: white; border-bottom: 5px solid #D2b48c'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posted by " . $recipeRow['u_username'] . "</h4>";

?>
    </div>
    <div class='recipetext'>
<?php
echo $recipeRow['r_recipe'];
?>
</div>
</div>


<?php
include 'includes/footer.php';
?>