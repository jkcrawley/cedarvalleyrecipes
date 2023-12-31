<?php
session_start();
include 'includes/config.php';
include 'includes/head.php';

//sql for Featured Recipe
$featsql = "SELECT * FROM categories, recipes, users WHERE categories.c_id = recipes.r_cat AND recipes.r_users = users.u_id AND recipes.r_id = 1";
$featresult = mysqli_query($conn, $featsql) or die("Bad Query: $featsql");
$featrow = mysqli_fetch_array($featresult, MYSQLI_ASSOC);

//SQL for the 3 most recently added recipes
$recsql = "SELECT * FROM categories, recipes, users WHERE categories.c_id = recipes.r_cat AND recipes.r_users = users.u_id ORDER BY r_date DESC LIMIT 3;";
$recres = mysqli_query($conn, $recsql) or die ("Bad Query: $recsql");

//format date
$phpdate = strtotime($featrow['r_date']);
$mysqldate = date('m-d-Y', $phpdate);

?>
<div class='herocontainer'>
    <div class='bannerbox'>
        <div class='banner'>
    <!--Search button-->
<?php

include "includes/searchbar.php";

?>

        </div>
    </div>
</div>
<div class='maincontent'>
    <div class='special'>
        
        <a href='recipe.php?id=<?php echo $featrow['r_id']; ?>'>
        <div class='featured'>
        <h2 style='color: black;'>Today's special!</h2>
            <img src='users/userimages/<?php echo $featrow['r_image'];?>' width='100%' height='auto'/>
            <h3><?php echo $featrow['r_title'];?></h3>
            <h4>by: <?php echo $featrow['u_username']; ?></h4>
            <p><?php echo $featrow['r_description'];?></p>
            <p>Posted on <?php echo $mysqldate; ?></p>
        </div>
        </a>
    
        <div class='recent'>
        <h2>Recently Added</h2>
<?php


while($recrow = mysqli_fetch_array($recres, MYSQLI_ASSOC)){
    echo "<a href='recipe.php?id=" . $recrow['r_id'] . "'><div class='reclink'>";
    echo "<img src='users/userimages/" . $recrow['r_image'] . "' />";
    echo "<b>" . $recrow['r_title'] . "</b><br />Added by " . $recrow['u_username'] ."<br />";
    echo "</a></div>";
}

?>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>