<?php




$sql_querys = "SELECT pickup_schedule.schedule_id, pickup_schedule.collector_id, collector.collector_lastname, collector.collector_firstname, pickup_schedule.pickup_date, pickup_schedule.pickup_area,pickup_schedule.max_booking, pickup_schedule.schedule_status FROM pickup_schedule 
INNER JOIN collector ON pickup_schedule.collector_id = collector.collector_id ";

$result_array = array();
$conn = new mysqli("localhost",'root', '', "juncle");
$result = mysqli_query($conn , $sql_querys  );

 if($result ->  num_rows > 0 ){
     while ($row =$result -> fetch_assoc()){


        array_push($result_array, $row);
 

      
     }
    }
    echo json_encode($result_array);
    $conn ->close();
    ?>