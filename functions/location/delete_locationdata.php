<?php


    $locID = $_POST['id'];
    $conn = new mysqli("localhost",'root', '', "juncle");
  
    $sql_query = "DELETE FROM location WHERE location_id = '$locID'";
    if(mysqli_query($conn, $sql_query)) { 
        echo "Data Deleted Successfully";
       
    }


?>