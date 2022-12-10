<?php


//  $collector_Id = $_POST['select-collector'];
//  $pickupDate = $_POST['pick-up_Date'];
//  $pickupLocation = $_POST['pick-up-location'];
//  $scheduleStatus = $_POST['schedule-status'];
 

   $conn = new mysqli("localhost",'root', '', "juncle");
   $pickupLocation =$_POST['location'];
   $collector_Id = $_POST['collector'];
   $pickupDate =$_POST['date'];
   $scheduleStatus =$_POST['status']; 
   $limit =$_POST['max'];
   
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

    
   $sql_query = "INSERT INTO pickup_schedule (collector_id, pickup_date, pickup_area, max_booking, schedule_status, lat_top_left, lng_top_left,lat_top_right,lng_top_right,lat_bottom_right,lng_bottom_right, lat_bottom_left,lng_bottom_left)
                                           VALUES('$collector_Id', '$pickupDate', '$pickupLocation',' $limit','$scheduleStatus' ,'$lattopleft',' $lngtopleft'
                                           ,'$lattopright','$lngtopright', '$latbottomright', '$lngbottomright' , '$latbottomleft', '$lngbottomleft')";
 
  if(mysqli_query($conn, $sql_query)){
      echo "New record created successfully";
      echo $limit;
      $conn ->close();
    } else {
      echo "Error: " ;
    }
    }
  }



 
 

 ?>
 