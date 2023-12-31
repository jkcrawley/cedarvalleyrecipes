<?php
session_start();
error_reporting(0);
include"includes/head.php";
include"includes/config.php";

include"includes/searchbar.php";

$keyword = mysqli_real_escape_string($conn, $_GET['search']);

$sql = "SELECT * FROM recipes, users WHERE r_title LIKE '%".$keyword."%' OR r_description LIKE '%".$keyword."%' OR r_recipe LIKE '%".$keyword."%' GROUP BY r_id;";
$results = mysqli_query($conn, $sql);

if($keyword==''){
    echo '<h3>No keyword was entered</i></h3>';
} else {

if(mysqli_num_rows($results) > 0){
?>
    <h3>Search results for <i>"<?php echo $keyword ?>"</i></h3>
<?php
while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
    
?>

<p><a href='recipe.php?id=<?php echo $row['r_id']; ?>'><strong><?php echo $row['r_title']; ?></strong></a><br />
<?php
echo $row['r_description'];
?>
</p>
<?php
}
} 
else {

?>

<h3>There were no results for <i><?php echo $keyword; ?></i></h3>
<?php
    }
}
include"includes/footer.php";
?>