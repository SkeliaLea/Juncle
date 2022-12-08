<?php 
    require 'database.php'; 
    require 'pdf/fpdf.php';
    //session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title> Juncle Dashboard</title>
</head>
<script>
    function checkUserIsSignedIn() {
    if (localStorage.getItem("username") === null) {
        window.location.href = "index.php";
       
    } else {
        //Do nothing since the user is not yet authenticated

    }
}
</script>
<script>

    checkUserIsSignedIn();
    </script>
<body class="body-background">

    <?php
        include('components/header.php');
    ?>
    <section class="main_container row wrapper">
        <div class="col-2">
            <?php
                include('components/navbar.php');
            ?>
        </div>
        
      
            <br>
            </div>
            <div class="column-display-wrapper bg-white rounded shadow-sm" style="padding-top: 2%; width: 80%; height:100%; overflow:hidden; overflow-y: scroll;">
            <div class="col-3" style="padding-left:50px;">
          <!-- ari imo code -->
            <div style="width:1000px">
           <div style="display:flex;" >
            <h1 class=" float-start section title" style="flex:50%;padding-left: 5px; position:block;">Dashboard</h1>
            <button class="btn btn-secondary" style="height:40px;width:150px;padding-left: 5px; float:right; position:block" onclick = "location.href='generate_pdf.php'"> Generate PDF </button>
    </div>
            <!-- start dashboard management -->
            <div class="container" style ="padding-top: 2%;">
                <div class="row">
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Active Users</h5>
                        <div class="card-body text-success">
                            <h5 class="card-title" style="text-align: center;">
                            <?php 
                                $query_get_user = "select count(*) as user_count from user";
                                $query_run = mysqli_query($connection, $query_get_user);
                                $return_request_from_query_get_user = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['user_count'];
                                }
                            ?>
                            </h5>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Active Admins</h5>
                        <div class="card-body text-success">
                            <h5 class="card-title" style="text-align: center;">
                            <?php 
                                $query_get_admin = "select count(admin_id) as admin_count from admin where suspend_status = '0' and deleted_status != '1'";
                                $query_run = mysqli_query($connection, $query_get_admin);
                                $return_request_from_query_get_admin = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['admin_count'];
                                }
                            ?>
                            </h5>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Hired Collectors</h5>
                        <div class="card-body text-success">
                            <h5 class="card-title" style="text-align: center;">
                            <?php 
                                $query_get_collector = "select count(collector_id) as collector_count from collector where account_status = '1'";
                                $query_run = mysqli_query($connection, $query_get_collector);
                                $return_request_from_query_get_collector = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['collector_count'];
                                }
                            ?>
                            </h5>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Booking Request</h5>
                        <div class="card-body text-success" style="text-align: center;">
                            <h5 class="card-title" style="text-align: center;">
                            <?php 
                                $query_get_booking = "select count(booking_id) as booking_count from booking";
                                $query_run = mysqli_query($connection, $query_get_booking);
                                $return_request_from_query_get_booking = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['booking_count'];
                                }
                            ?>
                            </h5>
                        </div>
                        </div>
                    </div>
                </div>
                </div>


                <div class="container" style ="padding-top: 2%;">
                <div class="row">
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Accepted Scrap Types</h5>
                        <div class="card-body text-success" style="text-align: center;">
                            <?php 
                                $query_get_scrap_type= "select count(scrap_id) as scrap_count from scrap_type";
                                $query_run = mysqli_query($connection, $query_get_scrap_type);
                                $return_request_from_query_get_scrap_type = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['scrap_count'];
                                }
                            ?> 
                        </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Number of Assigned Pickup Schedule</h5>
                        <div class="card-body text-success" style="text-align: center;">
                            <?php 
                                $query_get_pickup_schedule= "select count(schedule_id) as schedule_count from pickup_schedule";
                                $query_run = mysqli_query($connection, $query_get_pickup_schedule);
                                $return_request_from_query_get_pickup_schedule = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['schedule_count'];
                                }
                            ?> 
                        </div>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="card border-success mb-3" style="max-width: 18rem; ">
                    <h5 class="card-header" style="background:#2E8B57 ;border-top-radius:20px; color:white; ">Total Amount For Payment &nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        <div class="card-body text-success">
                            <h5 class="card-title" style="text-align: center;">₱ 
                            <?php 
                                $query_get_invoice= "select SUM(net_amount_due) as amount_count from invoice where payment_status != 1";
                                $query_run = mysqli_query($connection, $query_get_invoice);
                                $return_request_from_query_get_invoice = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                    if($row['amount_count'] == 0){
                                    echo "0.00";
                                    }
                                    else{
                                       
                                        echo $row['amount_count'];
                                    }
                                
                                }
                            ?> 
                            </h5>   
                        </div>
                        </div>
                    </div>
                    <div style="padding-bottom:20%;">
                                    <!-- end -->    <h1 class=" float-start section title" style="flex:50%;padding-left: 5px; position:block;">Graphical Report</h1>

                                    <?php




        $query= "select monthname(booking_created) as monthname, count(*) as count from booking where year(booking_created) >= year(CURDATE()) GROUP BY monthname";
                             


    
                            $query_run = mysqli_query($connection,$query
                            );
                            
                            if(mysqli_num_rows($query_run) > 0 ){
                                $dataPoints = array();
                                while($data = mysqli_fetch_array($query_run)){
                             
                
                                    array_push($dataPoints, array(
                                        'month'=>$data['monthname'],
                                        'count'=>$data['count']

                                    ));
                                }
                             
                            }





                    $m1 = 0;
                    $m2 = 0;
                    $m3 = 0;
                    $m4 = 0;
                    $m5 = 0;
                    $m6 = 0;
                    $m7 = 0;
                    $m8 = 0;
                    $m9 = 0;
                    $m10 = 0;
                    $m11= 0;
                    $m12= 0;
               

                    foreach($dataPoints as $value){
                        if($value['month']=="January")
                            $m1 = $value['count'];
                            if($value['month']=="February")
                            $m2 = $value['count'];
                            if($value['month']=="March")
                            $m3 = $value['count'];
                            if($value['month']=="April")
                            $m4 = $value['count'];
                            if($value['month']=="May")
                            $m5 = $value['count'];
                            if($value['month']=="June")
                            $m6 = $value['count'];
                            if($value['month']=="July")
                            $m7 = $value['count'];
                            if($value['month']=="August")
                            $m8 = $value['count'];
                            if($value['month']=="September")
                            $m9 = $value['count'];
                            if($value['month']=="October")
                            $m10 = $value['count'];
                            if($value['month']=="November")
                            $m11 = $value['count'];
                            if($value['month']=="December")
                            $m12 = $value['count'];
                    }              
 
 $dataPoint = array(
    
     array("label"=> "January", "y"=> $m1),
     array("label"=> "Feburary", "y"=> $m2),
     array("label"=> "March", "y"=> $m3),
     array("label"=> "May", "y"=> $m4),
     array("label"=> "April", "y"=> $m5),
     array("label"=> "June", "y"=> $m6),
     array("label"=> "July", "y"=> $m7),
     array("label"=> "August", "y"=> $m8),
     array("label"=> "September", "y"=> $m9),
     array("label"=> "October", "y"=> $m10),
     array("label"=> "November", "y"=> $m11),
     array("label"=> "December", "y"=> $m12),


 );



 $query2= "SELECT 
        p.pickup_area as pickup,
        COUNT(b.booking_id) as countbook
        FROM 
        pickup_schedule p, booking b
        WHERE 
        p.schedule_id = b.schedule_id
        GROUP BY 
        p.pickup_area";
 $query_run2 = mysqli_query($connection,$query2);
 
 if(mysqli_num_rows($query_run) > 0 ){
     $data1 = array();
     while($data = mysqli_fetch_array($query_run2)){
  
        array_push($data1, array("label"=> $data['pickup'], "y"=> $data['countbook']),);
 
     }
  
 }


 $query3 = "SELECT 
 YEAR(date_of_payment) AS `Year`,
 monthname(date_of_payment) AS `Month`, 
 SUM(total_amount) AS `total`
FROM 
 payment p, invoice i, booking b
WHERE 
 p.invoice_id = i.invoice_id
AND
 b.booking_id = i.booking_id
AND
 b.booking_status = 3 -- check if ang booking is done na. meaning 'paid'
GROUP BY 
 YEAR(date_of_payment), MONTH(date_of_payment)
ORDER BY 
 YEAR(date_of_payment), MONTH(date_of_payment)";


$query3 = mysqli_query($connection,$query3);

if(mysqli_num_rows($query_run) > 0 ){
$data2 = array();
while($data = mysqli_fetch_array($query3)){

 array_push($data2, array("label"=> $data['Month'], "y"=> $data['total']),);

}

}



     
 ?>
 


                                    <script>
                                        window.onload = function () {
                                        
                                        var chart = new CanvasJS.Chart("chartContainer", {
                                            animationEnabled: true,
                                            //theme: "light2",
                                            title:{
                                                text: "Yearly Pick-Up Schedule "
                                            },
                                            axisX:{
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            axisY:{
                                                title: "In Number of Schedule ",
                                                includeZero: true,
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            toolTip:{
                                                enabled: false
                                            },
                                            data: [{
                                                type: "area",
                                                dataPoints: <?php echo json_encode($dataPoint, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chart.render();
                                        

                                        var chartychart = new CanvasJS.Chart("areabook", {
                                            animationEnabled: true,
                                            //theme: "light2",
                                            title:{
                                                text: "Booking per Area "
                                            },
                                            axisX:{
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            axisY:{
                                                title: "Number of Bookings ",
                                                includeZero: true,
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            toolTip:{
                                                enabled: false
                                            },
                                            data: [{
                                                type: "column",
                                                dataPoints: <?php echo json_encode($data1, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chartychart.render();
                                        
                                        var chartycharty = new CanvasJS.Chart("booklang", {
                                            animationEnabled: true,
                                            //theme: "light2",
                                            title:{
                                                text: "Total Payment per Month "
                                            },
                                            axisX:{
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            axisY:{
                                                title: "Total Payment",
                                                includeZero: true,
                                                crosshair: {
                                                    enabled: true,
                                                    snapToDataPoint: true
                                                }
                                            },
                                            toolTip:{
                                                enabled: false
                                            },
                                            data: [{
                                                type: "column",
                                                dataPoints: <?php echo json_encode($data2, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chartycharty.render();
                                        } 
</script>




</head>
<body>
    <br> <br> <br> <br>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br>

<div id="areabook" style="height: 370px; width: 100%;"></div>
<br>

<div id="booklang" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
                </div>
                </div>

            
                </div>
            
                
    </section>
    <br>
    

                                    </div>
</body>
<script type="text/javascript">
        $(document).ready(function() {
                      $("#scrapWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                      $("#userWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#scheduleWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#dashboardWrap").addClass('active_nav_item').removeClass('inActive_nav_item');
                        $("#rfWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#notifWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                    })

</script>


</html> 



