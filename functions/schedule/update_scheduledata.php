<?php

$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
   $conn = new mysqli("localhost",'root', '', "juncle");
   $schedule_id =$_POST['schedule_id'];
   $pickupLocation =$_POST['location'];
   $collector_Id = $_POST['collector'];
   $pickupDate =$_POST['date'];
   $limit =  $_POST['limit'];
   $scheduleStatus =$_POST['status'];

  //  $lattopleft = $_POST["lattopleft"]; 
  //  $lngtopleft = $_POST['lngtopleft'];
  //  $lattopright = $_POST['lattopright']; 
  //  $lngtopright = $_POST['lngtopright']; 
  //  $latbottomright = $_POST['latbottomright']; 
  //  $lngbottomright = $_POST['lngbottomright']; 
  //  $latbottomleft = $_POST['latbottomleft']; 
  //  $lngbottomleft = $_POST['lngbottomleft']; 

  $query_location = "SELECT * FROM location where location_id = '$pickupLocation'"; 
  $execute_query = mysqli_query($conn, $query_location);

  if ($execute_query->num_rows > 0){
    while ($row= $execute_query ->fetch_assoc()){
   $lattopleft = $row["lat_top_left"]; 
   $lngtopleft =  $row['lng_top_left'];
   $lattopright =  $row['lat_top_right']; 
   $lngtopright =  $row['lng_top_right']; 
   $latbottomright =  $row['lat_bottom_right']; 
   $lngbottomright =  $row['lng_bottom_right']; 
   $latbottomleft =  $row['lat_bottom_left']; 
   $lngbottomleft =  $row['lng_bottom_left']; 


   $sql_query = "UPDATE pickup_schedule  SET collector_id = '$collector_Id', pickup_date = '$pickupDate', pickup_area = '$pickupLocation',max_booking = '$limit' ,schedule_status = '$scheduleStatus', lat_top_left = $lattopleft, lng_top_left = $lngtopleft,lat_top_right =$lattopright,lng_top_right= $lngtopright,lat_bottom_right = $latbottomright,lng_bottom_right = $lngbottomright, lat_bottom_left = $latbottomleft,lng_bottom_left = $lngbottomleft WHERE schedule_id = '$schedule_id'";
                                           
 
   if(mysqli_query($conn, $sql_query)){
       echo "UPDATED successfully";
       header('location:/admin_schedule_management.php');
       $conn ->close();
     } else {
       echo "Error: " ;
     }
  

    }
  }
 
  
 

 ?>
 