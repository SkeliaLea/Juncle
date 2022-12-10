<?php

if (isset($_POST['btn-add-schedule'])) {
    
    $collector_Id = $_POST['select-collector'];
    $pickupDate = $_POST['pick-up_Date'];
    $pickupLocation = $_POST['pick-up-location'];
    $scheduleStatus = $_POST['schedule-status'];

    if($pickupLocation == "") {

    } 
    else {
      $conn = new mysqli("localhost",'root', '', "juncle");

      $sql_query = "INSERT INTO pickup_schedule (collector_id, pickup_date, pickup_area, schedule_status)
                                              VALUES('$collector_Id', '$pickupDate', '$pickupLocation','$scheduleStatus' )";
  
      if(mysqli_query($conn, $sql_query)){
        echo "New record created successfully";
      } else {
        echo "Error: " ;
      }
    }
    

}

// // if(isset($_POST['delete'])) {

// //     $scheduleId = $_POST['delete'];
// //     $conn = new mysqli("localhost",'root', '', "juncle");
  
// //     $sql_query = "DELETE FROM pickup_schedule WHERE schedule_id = '$scheduleId'";
// //     if(mysqli_query($conn, $sql_query)) { 
// //         header('Location: ../admin_schedule_management.php');
      
// //     }
// //     echo "Data Deleted";
//   }


  if(isset($_POST['update'])) {

    $scheduleId = $_POST['update'];
    $collector_Id = $_POST['select-collector'];
    $pickupDate = $_POST['pick-up_Date'];
    $pickupLocation = $_POST['pick-up-location'];
    $scheduleStatus = $_POST['schedule-status'];

    $conn = new mysqli("localhost",'root', '', "juncle");
  
    $sql_query = "UPDATE pickup_schedule SET collector_id = '$collector_Id', pickup_date = '$pickupDate', pickup_area = '$pickupLocation', schedule_status = '$scheduleStatus' WHERE schedule_id = $scheduleId ";
    if(mysqli_query($conn, $sql_query)) { 
        header('Location: ../admin_schedule_management.php');
    }
    
  }



  
if(isset($_POST['btn-cancel-update'])) {
    header('Location: ../admin_schedule_management.php');
  }




  



function populate(){
 
    $conn = new mysqli("localhost",'root', '', "juncle");
    $sql ="SELECT * FROM collector ";
  
    $result = mysqli_query($conn, $sql); 
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
  
  
          echo "<option value='".$row['collector_id']."'>".$row['collector_lastname']." ". $row['collector_firstname']."</option>";
        
      }
  } else {
      echo "0 results";
  }
  
  
  }


  function location_data(){

    $conn = new mysqli("localhost",'root', '', "juncle");
    $sql ="SELECT * FROM location ";
  
    $result = mysqli_query($conn, $sql); 
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
  
  
          echo "<option value='".$row['location_id']."'>".$row['location_name']."</option>";
        
      }
  } else {
      echo "0 results";
  }
  
  }

  function displaydata(){

    $sql_querys = "SELECT pickup_schedule.schedule_id, collector.collector_last_name, collector.collector_first_name, pickup_schedule.pickup_date, pickup_schedule.pickup_area, pickup_schedule.schedule_status FROM pickup_schedule 
    INNER JOIN collector ON pickup_schedule.collector_id = collector.collector_id ";

    $sql_query = "SELECT * FROM pickup_schedule";
    $conn = new mysqli("localhost",'root', '', "juncle");
    $result = mysqli_query($conn , $sql_querys  );

     if($result ->  num_rows > 0 ){
         while ($row =$result -> fetch_assoc()){

            if($row['schedule_status']== '1'  ){
                $status = 'Open';
            }
            else {
              $status = 'Close';
            }
            echo "<tr><td>".$row['schedule_id']."</td><td>".$row['collector_last_name']." ".$row['collector_first_name']."</td><td>".$row['pickup_date']."</td><td>".$row['pickup_area']."</td><td>".$row['schedule_status']."</td><td><button type = 'submit'  class='btn btn-warning' form='table-form' name='edit' value = ".$row['schedule_id'].">Update</button><button type = 'submit' class='btn btn-danger' form='nameform' name='delete' value = ".$row['schedule_id'].">Delete</button></td></tr>";
          
         }
     
     }
    



}

?>