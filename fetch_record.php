<?php
//Include database connection
include "includes/config.php";
if($_POST['rowid']) {
    $id = $_POST['rowid']; //escape 
    echo $id;
    // Run the Query
    // Fetch Records
    // Echo the data you want to show in modal
    echo "Hello world Are you working";
 }
?>