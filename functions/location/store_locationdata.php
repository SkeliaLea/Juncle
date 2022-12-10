<?php


//  $collector_Id = $_POST['select-collector'];
//  $pickupDate = $_POST['pick-up_Date'];
//  $pickupLocation = $_POST['pick-up-location'];
//  $scheduleStatus = $_POST['schedule-status'];
 

   $conn = new mysqli("localhost",'root', '', "juncle");
   $pickupLocation =$_POST['location'];
   $lattopleft = $_POST["lattopleft"]; 
   $lngtopleft = $_POST['lngtopleft'];
   $lattopright = $_POST['lattopright']; 
   $lngtopright = $_POST['lngtopright']; 
   $latbottomright = $_POST['latbottomright']; 
   $lngbottomright = $_POST['lngbottomright']; 
   $latbottomleft = $_POST['latbottomleft']; 
   $lngbottomleft = $_POST['lngbottomleft']; 
 
   $sql_query = "INSERT INTO location (location_name, lat_top_left, lng_top_left,lat_top_right,lng_top_right,lat_bottom_right,lng_bottom_right, lat_bottom_left,lng_bottom_left)
                                           VALUES('$pickupLocation','$lattopleft',' $lngtopleft'
                                           ,'$lattopright','$lngtopright', '$latbottomright', '$lngbottomright' , '$latbottomleft', '$lngbottomleft')";
 
  if(mysqli_query($conn, $sql_query)){
      echo "New record created successfully";
      $conn ->close();
    } else {
      echo "Error: " ;
    }
 
 

 ?>
 