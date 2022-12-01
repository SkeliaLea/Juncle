<?php
include_once("database.php"); 



if(isset($_POST["From"], $_POST["to"]))
{
    $result = '';
    $query = "SELECT * FROM pickup_schedule inner join collector on collector.collector_id = pickup_schedule.collector_id WHERE pickup_date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $sql = mysqli_query($connection, $query);
    $result .='
    <table id= "date_range"style="text-align:center; "class="table table-hover"width="100%"><tr><th>Action</th> <th>Schedule ID</th><th>Collector Id</th> <th>Pick-up Area</th> <th>Pick-up Date</th><th>Max Booking</th><th>Status</th> <th>Latitude Top Left</th> <th>Longitude Top Left</th>  <th>Latitude Top Right</th> <th>Longitude Top Right</th> <th>Latitude Bottom Right</th>  <th>Longitude Bottom Right</th> <th>Latitude Bottom Left</th>  <th>Longitude Bottom Left</th> <tr>
    
    ';
    
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_array($sql))
        {
            if($row["schedule_status"] == 1) {
                $status = "Open";
            }
            else {
                $status = "Close";
            }
            $result .='
            <tr>

            <td>
            <button type="button" class="btn btn-warning" id="edit-schedule"  value="'.$row["schedule_id"].'"><ion-icon name="create-outline"></ion-icon></button>
            <button type="button" class="btn btn-danger"  id="delete-schedule" name="delete" value="'.$row["schedule_id"].'"><ion-icon name="trash-outline"></ion-icon></button>
            </td>    

            <td>'.$row["schedule_id"].'</td>
            
            <td class="collector-data" id="'.$row["collector_id"].'">'.$row["collector_firstname"].' '.' '.$row["collector_lastname"].'</td>


            <td>'.$row["pickup_area"].'</td>
            <td>'.$row["pickup_date"].'</td>
            <td>'.$row["max_booking"].'</td>
            <td class="status-data">'. $status.'</td>
            <td>'.$row["lat_top_left"].'</td>
            <td>'.$row["lng_top_left"].'</td>
            <td>'.$row["lat_top_right"].'</td>
            <td>'.$row["lng_top_right"].'</td>
            <td>'.$row["lat_bottom_right"].'</td>
            <td>'.$row["lng_bottom_right"].'</td>
            <td>'.$row["lat_bottom_left"].'</td>
            <td>'.$row["lng_bottom_left"].'</td>
            </tr>'
            
            ;

        

            /* 
                BEFORE without concat
             
    }       
            <td>'.$row["collector_id"].'</td>
            <td>'.$row["collector_firstname"].'</td>
            <td>'.$row["collector_lastname"].'</td> */
        }
            
       
    }
    else
    {
        $result .='
        <tr>
        <td colspan="16">No Purchased Item Found</td>
        </tr>';
    }
    $result .='</table>';
    echo $result;
    
}
?>
