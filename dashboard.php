<?php 
    require 'database.php'; 
    session_start();
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
                                $query_get_user = "select count(user_id) as user_count from user";
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
                                $query_get_invoice= "select SUM(net_amount_due) as amount_count from invoice";
                                $query_run = mysqli_query($connection, $query_get_invoice);
                                $return_request_from_query_get_invoice = mysqli_num_rows($query_run) > 0;

                                while($row = mysqli_fetch_array($query_run)){
                                echo $row['amount_count'];
                                }
                            ?> 
                            </h5>   
                        </div>
                        </div>
                    </div>
                    <div style="padding-bottom:20%;">
</div>
                </div>
                </div>
                <!-- end -->
            
                </div>
                
    </section>
    <br>
    

                                    </div>
</body>


</html> 



