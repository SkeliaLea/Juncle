<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "juncle");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM pickup_schedule,collector
  WHERE pickup_schedule.collector_id = collector.collector_id 
  AND collector.collector_id LIKE '".$search."'

  
 ";
}
else
{
 $query = "
 SELECT pickup_schedule.schedule_id, pickup_schedule.collector_id, collector.collector_lastname, collector.collector_firstname, pickup_schedule.pickup_date, pickup_schedule.pickup_area,pickup_schedule.max_booking, pickup_schedule.schedule_status FROM pickup_schedule 
  INNER JOIN collector ON pickup_schedule.collector_id = collector.collector_id "
 ;
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <table style="text-align:center;"class="table table-hover"width="100%"><tr> <th>Schedule ID</th><th>Collector</th> <th>Pick-up Area</th> <th>Pick-up Date</th><th>Max Booking</th><th>Status</th> <th>Action</th><tr>
 ';   
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr class="schedule-data">
    <td class="id-data">'.$row["schedule_id"].'</td>
    <td class="collector-data">'.$row["collector_id"].'>'.$row["collector_firstname"].' '.$row["collector_firstname"].'</td>
    <td class="pickup-data">'.$row["pickup_area"].'</td>
    <td class="date-date">'.$row["pickup_date"].'</td>
    <td class="maxBooking-data">'.$row["max_booking"].'</td>
    <td class="status-data">'.$row["schedule_status"].'</td>
    <td><button type="button" class="btn btn-warning" id="edit-schedule"  value = '.$row['schedule_id'].'><ion-icon name="create-outline"></ion-icon></button><button type="button" class="btn btn-danger"  id="delete-schedule" name="delete" value = '.$row['schedule_id'].'> <ion-icon name="trash-outline"></ion-icon></button></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
   
 echo '<h4  class="text-muted" style="text-align:center;">No results for "'.$search.'"</h4>';
 echo '<p class="text-muted"  style="text-align:center;"> Not finding a details that you want? Please contact "@superAdmin".</p>';


}

?>