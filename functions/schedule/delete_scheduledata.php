<?php


    $scheduleId = $_POST['id'];
    $conn = new mysqli("localhost",'root', '', "juncle");
  
    $sql_query = "DELETE FROM pickup_schedule WHERE schedule_id = '$scheduleId'";
    if(mysqli_query($conn, $sql_query)) { 
        echo "Data Deleted Successfully";
       
    }


?>