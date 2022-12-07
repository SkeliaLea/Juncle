<?php 
    include 'database.php';
    include 'functions/schedule.php';
  

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/mainComponent.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/> 

    <title>Manage Schedule</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer=""></script>
    <script src ='scripts/schedule.js' type="text/javascript"> </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>


<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
    <style>
            th,td {
                white-space : nowrap;
                padding: 20px;
            }
        </style>
</head>
<script>
    // function checkUserIsSignedIn() {
    // if (localStorage.getItem("username") === null) {
    //     window.location.href = "index.php";
       
    // } else {
    //     //Do nothing since the user is not yet authenticated

    // }
// });

</script>
<script>
    //checkUserIsSignedIn();
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
        <div class="col-7">
            <div class="column-display-wrapper bg-white mx-1 my-2 w-100 p-3 rounded shadow-sm">
                <h4 ~>Schedule Management</h4>
                
                    <div class="d-flex justify-content-between align-items-center mt-3">

                    <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="search-outline"></ion-icon></span>
                        <input type="text" name="search_text" id="search_text" placeholder="Search by Schedule Details" class="form-control" />
                        </div>
                    </div>
                    
                    <!-- TO AND FROM DATE FILTER  -->
                    &nbsp;&nbsp;
                            <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="From" id="From" class="form-control" placeholder="From Date"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="to" id="to" class="form-control" placeholder="To Date"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <br>                                     
                                    </div>
                                </div>
                            </div>
                            </div>
                            &nbsp;&nbsp;
                            <ul class="booking-status-filter mb-0 d-inline-flex p-0 ">
                                <input type="button" name="range" id="range" value="Filter" class="btn btn-success"/>
                                &nbsp;&nbsp;
                                <input type="button" name="reset" id="reset" value="Reset" class="btn btn-outline-warning btn-sm"/>
                                &nbsp;&nbsp;
                            </ul>
                    <!-- END OF TO AND FROM DATE FILTER  -->

                        <div class="d-flex align-items-center justify-content-between">
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Schedule</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body" >
                                            <form class="form-inline" id="myForm" action="#">

                                            <div class="form-group mx-sm-3 mb-2">
                                                    <label for="pickUpLocation" class="sr-only">Pick-up Location</label>
                                                    <input type="text" class="form-control" id="pickupLocation" name="pick-up-location"  placeholder="Location" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="Pick-up Date" class="sr-only">Pick-up Date:</label>
                                                    <input type="date"  class="form-control" id="pickupDate" value='<?php echo date("Y-m-d")?>'  name="pick-up_Date" required><br>
                                                <script language="javascript">
                                                var today = new Date();
                                                var dd = String(today.getDate()).padStart(2, '0');
                                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                                var yyyy = today.getFullYear();

                                                today = yyyy + '-' + mm + '-' + dd;
                                                $('#pickupDate').attr('min',today);
                                                $('#edit-pickup-date').attr('min',today);
                                                
                                                </script>
                                                </div>
                                                <div style= "margin-top: -20px;" class="form-group mx-sm-3 mb-2">
                                                    <label for="collector_Selection" class="sr-only">Select a Collector</label>
                                                    <select  class="form-select" name="select-collector" id="selectedCollector" aria-label="Default select example">
                                                    <?php populate(); ?>
                                                    </select>
                                                </div>
                                                <div style= "margin-top: -5px;" class="form-group mx-sm-3 mb-2">
                                                    <label for="schedule_status_selection" class="sr-only">Select a Collector</label>
                                                    <select  class="form-select" name="schedule-status" id="scheduleStatus" aria-label="Default select example">
                                                            <option value ="1">Open</option>
                                                            <option value ="0">Close</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="bookinglimit" class="sr-only">Booking Limit (10-50):</label>
                                                    <input type="text" class="form-control" value='10' id="bookingLimit" min="10" max="50" size='2' name="booking-limit"  placeholder="No. of booking" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-top-left" class="sr-only">Latitude - top - left</label>
                                                    <input type="text" class="form-control" id="lattopleft" name="lat-top-left"  placeholder="Latitude Top Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-top-left" class="sr-only">Longitude - top - leftt</label>
                                                    <input type="text" class="form-control" id="lngtopleft" name="lng-top-left"  placeholder="Longitude Top Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-top-right" class="sr-only">Latitude - top - right</label>
                                                    <input type="text" class="form-control" id="lattopright" name="lat-top-right"  placeholder="Latitude Top Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-top-right" class="sr-only">Longitude - top - right</label>
                                                    <input type="text" class="form-control" id="lngtopright" name="lng-top-right"  placeholder="Longitude Top Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-bottom-right" class="sr-only">Latitude - bottom - right</label>
                                                    <input type="text" class="form-control" id="latbottomright" name="lat-bottom-right"  placeholder="Latitude Bottom Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-bottom-right" class="sr-only">Longitude - bottom - right</label>
                                                    <input type="text" class="form-control" id="lngbottomright" name="lng-bottom-right"  placeholder="Longitude Bottom Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-bottom-left" class="sr-only">Latitude - bottom - left</label>
                                                    <input type="text" class="form-control" id="latbottomleft" name="lat-bottom-left"  placeholder="Latitude Bottom Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-bottom-left" class="sr-only">Longitude - bottom - left</label>
                                                    <input type="text" class="form-control" id="lngbottomleft" name="lng-bottom-left"  placeholder="Longitude Bottom Left" required>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                                <button type="submit" form="myForm" name="btn-add-schedule" id="add-schedule" class="btn btn-primary" >Add Schedule</button>
                                            <button type="button" form="nameform" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAl -->
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Add Schedule
                            </button>
                        
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="scrollbarSchedule pe-2" style="overflow: scroll; ">
                        <div class="schedule-list">
                            <div >
                            <table id= "date_range"style="text-align:center; "class="table table-hover"width="100%"><tr><th>Action</th> <th>Schedule ID</th><th>Collector Id</th> <th>Pick-up Area</th> <th>Pick-up Date</th><th>Max Booking</th><th>Status</th> <th>Latitude Top Left</th> <th>Longitude Top Left</th>  <th>Latitude Top Right</th> <th>Longitude Top Right</th> <th>Latitude Bottom Right</th>  <th>Longitude Bottom Right</th> <th>Latitude Bottom Left</th>  <th>Longitude Bottom Left</th> <tr>
                                <?php
                        
                                    $sqlGetScheduleData = "SELECT * FROM pickup_schedule inner join collector on collector.collector_id = pickup_schedule.collector_id";
                                    $executeQuery = mysqli_query($connection, $sqlGetScheduleData);
                                
                                    while($row = mysqli_fetch_array($executeQuery)){
                                ?>
                                <tr class="schedule-data">
                                <td><button type="button" class="btn btn-warning" id="edit-schedule"  value = '<?php echo $row['schedule_id'];?>'><ion-icon name="create-outline"></ion-icon></button><button type="button" class="btn btn-danger"  id="delete-schedule" name="delete" value = '<?php echo $row['schedule_id'];?>'> <ion-icon name="trash-outline"></ion-icon></button></td>    
                                    <td class="id-data"><?php echo $row['schedule_id']; ?></td>
                                    <td class="collector-data" id="<?php echo $row['collector_id']; ?>"><?php echo $row['collector_firstname']." ".$row['collector_lastname'];; ?></td>
                                    <td class="area-data"><?php echo $row['pickup_area']; ?></td>
                                    <td class="date-data"><?php echo $row['pickup_date']; ?></td>
                                    <td class="max-data"><?php echo $row['max_booking'];?></td>
                                    <td class="status-data">
                                        <?php 
                                            if($row['schedule_status'] == 0) {
                                                echo "Close";
                                                
                                            } else {
                                                echo "Open";
                                            }          
                                        ?>
                                    </td>

                                    <td class="lattopleft "><?php echo $row['lat_top_left'];?></td>
                                    <td class="lngtopleft"><?php echo $row['lng_top_left'];?></td>
                                    <td class="lattopright"><?php echo $row['lat_top_right'];?></td>
                                    <td class="lngtopright"><?php echo $row['lng_top_right'];?></td>
                                    <td class="latbottomright"><?php echo $row['lat_bottom_right'];?></td>
                                    <td class="lngbottomright"><?php echo $row['lng_bottom_right'];?></td>
                                    <td class="latbottomleft"><?php echo $row['lat_bottom_left'];?></td>
                                    <td class="lngbottomleft"><?php echo $row['lng_bottom_left'];?></td>
               
                                </tr>  
                        </tr>
                        <?php 
                            }
                        ?>
                                </table>     
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-3">
            <div class="column-display-wrapper bg-white my-2 py-2 px-3 w-100 rounded shadow-sm" style="overflow: scroll;">
                <p class="fs-4 text-muted m-0" style="text-align:center">Content Board</p>
               
                <div id="edit-schedule-form">
                 <form> 
                        <div style = "margin-top:20px; text-align: center; "class="mb-3">
                        <h6>Schedule ID</h6>   <p id="schedule-id"></p>
                        </div>
                        <div class="mb-3">
                        <label for="pickuplocation" class="form-label">Pick-up Location:</label>
                        <input type="text" class="form-control" id="edit-pickup-location">
                        </div>
                        <div class="mb-3">
                        <label for="Pick-up Date" class="sr-only">Pick-up Date:</label>
                                    <input type="date"  class="form-control" id="edit-pickup-date" name="pick-up_Date">
                                    <script language="javascript">
                                                var today = new Date();
                                                var dd = String(today.getDate()).padStart(2, '0');
                                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                                var yyyy = today.getFullYear();

                                                today = yyyy + '-' + mm + '-' + dd;
                                       
                                                $('#edit-pickup-date').attr('min',today);
                                                
                                            </script>
                        </div>
                        <div class="mb-3">

                                <label for="collector_Selection" class="sr-only">Select a Collector:</label>
                                <select  class="form-select" name="select-collector" id="edit-selected-collector">
                                <?php populate(); ?>
                                </select>
                                        
                        </div>
                        <div class="mb-3">
                        <label for="collector_Selection" class="sr-only">Schedule Status:</label>
                                <select  class="form-select" name="schedule-status" id="edit-schedule-status" aria-label="Default select example">
                                        <option value ="1">Open</option>
                                        <option value ="0">Close</option>
                                </select>
                        </div>
                        <div class="mb-3">
                                <label for="booking-limit" class="sr-only">Booking Limit (10-50)</label>
                                <input type="number" class="form-control" id="booking-limit" min="10" max="50" size='2'name="booking-limit"  placeholder="No. of booking">
                         </div> <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-top-left" class="sr-only">Latitude - top - left</label>
                                                    <input type="number" class="form-control" id="editlattopleft" name="lat-top-left"  placeholder="Latitude Top Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-top-left" class="sr-only">Longitude - top - leftt</label>
                                                    <input type="number" class="form-control" id="editlngtopleft" name="lng-top-left"  placeholder="Longitude Top Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-top-right" class="sr-only">Latitude - top - right</label>
                                                    <input type="number" class="form-control" id="editlattopright" name="lat-top-right"  placeholder="Latitude Top Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-top-right" class="sr-only">Longitude - top - right</label>
                                                    <input type="number" class="form-control" id="editlngtopright" name="lng-top-right"  placeholder="Longitude Top Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-bottom-right" class="sr-only">Latitude - bottom - right</label>
                                                    <input type="number" class="form-control" id="editlatbottomright" name="lat-bottom-right"  placeholder="Latitude Bottom Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-bottom-right" class="sr-only">Longitude - bottom - right</label>
                                                    <input type="number" class="form-control" id="editlngbottomright" name="lng-bottom-right"  placeholder="Longitude Bottom Right" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lat-bottom-left" class="sr-only">Latitude - bottom - left</label>
                                                    <input type="number" class="form-control" id="editlatbottomleft" name="lat-bottom-left"  placeholder="Latitude Bottom Left" required>
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="lng-bottom-left" class="sr-only">Longitude - bottom - left</label>
                                                    <input type="number" class="form-control" id="editlngbottomleft" name="lng-bottom-left"  placeholder="Longitude Bottom Left" required>
                                                </div>
                        <button type="submit" id="submit-edit" class="btn btn-primary">Submit</button>
                        <button type="submit" id="cancel-edit" class="btn btn-danger">Cancel</button>
                 </form>
                </div>
                <div class="fs-4 text-muted m-0" style ="padding: 70px 0;text-align: center;" id="no-schedule-form">
                    <h5>No Content</h5>
                    <p style ="font-size : 0.6em; padding: 20px">Please select schedule to edit by clicking the "<ion-icon name="create-outline" style="font-size: 1em;"></ion-icon>"</p>
                </div>
                
            </div>
        </div>
    </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#scheduleWrap").addClass('active_nav_item').removeClass('inActive_nav_item');
        $("#dashboardWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#userWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#rfWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#notifWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
    })

    $("#search_text").keyup(function() {
        var searchInput = $(this).val().toUpperCase();
        var parent;
        var hasMatchId, hasMatchCollector, hasMatchArea, hasMatchDate, hasMatchMax, hasMatchStatus;

        $(".schedule-data").each(function(idxParent) {
            $(".id-data").each(function(idxID) {
                var rowID = $(this).text();
                if(idxID === idxParent) {
                    if($(this).text().includes(searchInput) || searchInput == "") {
                        hasMatchId = true;
                    } else {
                        hasMatchId = false;
                    }
                }
            })
            $(".collector-data").each(function(idxCollector) {
                var rowCollector = $(this).text().toUpperCase();
                if(idxCollector === idxParent) {
                    if(rowCollector.includes(searchInput) || searchInput == "") {
                        hasMatchCollector = true;
                    } else {
                        hasMatchCollector = false;
                    }
                }
            })
            $(".area-data").each(function(idxArea) {
                var rowArea = $(this).text().toUpperCase();
                if(idxArea === idxParent) {
                    if(rowArea.includes(searchInput) || searchInput == "") {
                        hasMatchArea = true;
                    } else {
                        hasMatchArea = false;
                    }
                }
            })
            $(".date-data").each(function(idxDate) {
                var rowDate = $(this).text().toUpperCase();
                if(idxDate === idxParent) {
                    if(rowDate.includes(searchInput) || searchInput == "") {
                        hasMatchDate = true;
                    } else {
                        hasMatchDate = false;
                    }
                }
            })
            $(".max-data").each(function(idxMax) {
                var rowMax = $(this).text().toUpperCase();
                if(idxMax === idxParent) {
                    if(rowMax.includes(searchInput) || searchInput == "") {
                        hasMatchMax = true;
                    } else {
                        hasMatchMax = false;
                    }
                }
            })
            $(".status-data").each(function(idxStatus) {
                var rowStatus = $(this).text().toUpperCase();
                if(idxStatus === idxParent) {
                    if(rowStatus.includes(searchInput) || searchInput == "") {
                        hasMatchStatus = true;
                    } else {
                        hasMatchStatus = false;
                    }
                }
            })

            if(hasMatchId || hasMatchCollector || hasMatchArea || hasMatchDate || hasMatchMax || hasMatchStatus) {
                $(this).show();
            } else {
                $(this).hide();
            }
        })

        
    })

</script>

                    <!-- TO AND FROM DATE FILTER SCRIPT     
                
                 NOTE: NEED api_schedule_date.php (dili ni ma work ang script kung wala ni na file)
                    -->

<script type="text/javascript" language="javascript">
 $(document).ready(function(){
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function(){
            $("#From").datepicker();
            $("#to").datepicker();
        });
 
        $('#range').click(function(){
            var From = $('#From').val();
            var to = $('#to').val();
            if(From != '' && to != '')
            {
                $.ajax({
                    url:"range.php",
                    method:"POST",
                    data:{From:From, to:to},
                    success:function(data)
                    {
                        $('#date_range').html(data);
                        $('#date_range').append(data.htmlresponse);
                    }
                });
            }
            else
            {
                alert("Please Select the Date Range");
            }
        });
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        //alert("test");
        location.reload(true);
        header('location:admin_schedule_management.php');  
            // e.preventDefault();
        
        // $("#From").val(''); // empty value
        // $("#to").val('');

        // $('#date_range').DataTable().destroy();
        // fetch();
        

    });
</script>
</html>