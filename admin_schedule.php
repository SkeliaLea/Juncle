<?php
    include('database.php');

    $BOOKING_STATUS_INT_PENDING = 1;
    $BOOKING_STATUS_INT_PROCESSING = 2;
    $BOOKING_STATUS_INT_FOR_PAYMENT = 3;
    $BOOKING_STATUS_INT_DONE = 4;
    $BOOKING_STATUS_INT_REJECTED = 5;

    $BOOKING_STATUS_STRING_PENDING = "Pending";
    $BOOKING_STATUS_STRING_PROCESSING = "Processing";
    $BOOKING_STATUS_STRING_FOR_PAYMENT = "For Paymnent";
    $BOOKING_STATUS_STRING_DONE = "Done";
    $BOOKING_STATUS_STRING_REJECTED = "Rejected";

    $EMPTY_STRING = "";

    function getTotalWeightOfScrapPerBooking($booking_id, $connection) {
        $sqlGetTotalWeight = "SELECT SUM(weight) as totalWeight FROM weight_ledger WHERE booking_id = '".$booking_id."'";
        $executeQuery = mysqli_query($connection, $sqlGetTotalWeight);
        $totalRows = mysqli_num_rows($executeQuery);
        if($totalRows > 0) {
            $totalWeight = mysqli_fetch_assoc($executeQuery);
            if($totalWeight['totalWeight'] != null) {
                return $totalWeight['totalWeight'];
            } else {
                return "TBA";
            }
            
        } 
    }

    function formatTrackingNumber($bookingId) {
        $trackingNumber = "".$bookingId;
        $trackingNumberPrefix = "";
        
        for($x = 5; $x > strlen($trackingNumber); $x--) {
            $trackingNumberPrefix = $trackingNumberPrefix."0";
        }

        $trackingNumber = $trackingNumberPrefix.$trackingNumber;
        return $trackingNumber;
    }

    function getBookingStatusValue($booking_status) {
        global $BOOKING_STATUS_INT_PENDING, $BOOKING_STATUS_INT_PROCESSING, $BOOKING_STATUS_INT_FOR_PAYMENT, 
                $BOOKING_STATUS_INT_DONE,  $BOOKING_STATUS_INT_REJECTED, $EMPTY_STRING, $BOOKING_STATUS_STRING_PENDING,
                $BOOKING_STATUS_STRING_PROCESSING, $BOOKING_STATUS_STRING_FOR_PAYMENT, $BOOKING_STATUS_INT_DONE,
                $BOOKING_STATUS_STRING_REJECTED;

        switch($booking_status) {
            case $BOOKING_STATUS_INT_PENDING :
                return $BOOKING_STATUS_STRING_PENDING;
            case $BOOKING_STATUS_INT_PROCESSING:
                return $BOOKING_STATUS_STRING_PROCESSING;
            case $BOOKING_STATUS_INT_FOR_PAYMENT:
                return $BOOKING_STATUS_STRING_FOR_PAYMENT;
            case $BOOKING_STATUS_INT_DONE:
                return $BOOKING_STATUS_INT_DONE;
            case $BOOKING_STATUS_INT_REJECTED:
                return $BOOKING_STATUS_STRING_REJECTED;
            default:
                return $EMPTY_STRING;
        }
    }

    function formatDate($date) {
        return date('F d Y', strtotime($date));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/mainComponent.css">
    <title>Dashboard</title>
</head>
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
                <h3>Schedule</h3>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="search-bar-container bg-white d-flex align-items-center p-1 rounded shadow-sm">
                                <img class="search-icon me-1" src="assets/search_icon.svg">
                                <input class="search_field p-0" type="text" placeholder="Search">
                            </div>
                            <p class="text-sm text-muted my-0 mx-3">In</p>
                            <select name="" id="" class="p-1 rounded shadow-sm me-3">
                                <option value="">Tracking Number</option>
                                <option value="">Scrap</option>
                                <option value="">Amount</option>
                                <option value="">Type</option>
                            </select>
                            <div class="d-flex align-items-center">
                                <p class="text-sm text-muted my-0 me-2">Status:</p>
                                <select name="" id="" class="p-1 rounded shadow-sm">
                                    <option value="">All</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Processing</option>
                                    <option value="3">For Payment</option>
                                    <option value="4">Done</option>
                                    <option value="5">Rejecred</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary btn-sm me-2">Apply filter</button>
                            <button class="btn btn-outline-secondary btn-sm">Reset Filter</button>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="scrollbarSchedule pe-2">
                    <div class="schedule-list">
                        <div class="month-separator w-100">
                            <p class="month-display text-sm text-center fw-bold text-muted">April 2022</p>
                            <!-- 
                                Populate Table
                             -->
                            <div class="month-schedule-list">
                            <?php
                                $getAllBookingDetails = "SELECT * FROM `booking` 
                                    LEFT JOIN `schedule` ON booking.schedule_id = schedule.schedule_id 
                                    LEFT JOIN `user` ON booking.user_id = user.user_id";
                                $executeQuery = mysqli_query($connection, $getAllBookingDetails);
                                $getRows = mysqli_num_rows($executeQuery);

                                if($getRows > 0) {
                                    while($bookingEntity = mysqli_fetch_assoc($executeQuery)) {
                                        echo '<div class="schedule-record p-3 rounded shadow-sm mb-3">
                                            <div class="card-info">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="trackingNo-wrapper d-flex justify-content-between align-items-center">
                                                        <p class="label-text fw-bold mb-0">
                                                            Tracking Number :
                                                        </p>
                                                        <p class="info-value strong ms-2 mb-0">
                                                            '.formatTrackingNumber($bookingEntity['booking_id']).'
                                                        </p>
                                                    </div>
                                                    <img class="search-icon me-1" src="assets/delete_schedule_icon.svg">   
                                                </div>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="weigh-wrapper d-flex justify-content-between align-items-center me-5">
                                                        <p class="label-text fw-bold mb-0">
                                                            Kg(s) :
                                                        </p>
                                                        <p class="text-muted ms-2 mb-0">
                                                            '.getTotalWeightOfScrapPerBooking($bookingEntity['booking_id'], $connection).'
                                                        </p>
                                                    </div>
                                                    <div class="scrap-wrapper d-flex justify-content-between align-items-center">
                                                        <p class="label-text fw-bold mb-0">
                                                            Scrap :
                                                        </p>
                                                        <p class="text-muted ms-2 mb-0">
                                                            '.$bookingEntity['scrap_type'].'
                                                        </p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center mt-3">
                                                        <div class="status-wrapper px-2 py-1 shadow-sm">
                                                            <p class="text-muted fw-bold m-0 text-sm">'.getBookingStatusValue($bookingEntity['booking_status']).'</p>
                                                        </div>
                                                        <p class="text-sm mx-2 m-0 fst-italic">started on</p>
                                                        <p class="text-sm m-0 fst-italic fw-bold">'.formatDate($bookingEntity['booking_modified']).'</p>
                                                    </div>
                                                    <button class="btn btn-outline-secondary btn-sm">View Record</button>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="column-display-wrapper bg-white my-2 py-2 px-3 w-100 rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="fs-4 text-muted m-0">Content Board</p>
                    <img class="search-icon me-1" src="assets/edit.svg">
                </div>
                <div class="scrollbarContent pe-3">
                    <div class="trackingNo-wrapper mt-4 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm">
                            Tracking Number :
                        </p>
                        <p class="info-value fw-bold strong ms-2 mb-0 text-sm">
                            123456789
                        </p>
                    </div>
                    <div class="rounded shadow-sm item-image-wrapper my-3">
                        <img src="" alt="">
                    </div>
                    <div class="scrap-item-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Scrap :
                        </p>
                        <p class="info-value  text-muted ms-2 mb-0 text-sm col-8">
                            Plastic Bottle
                        </p>
                    </div>
                    <div class="scrap-item-wrapper mt-2 d-flex row">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Description :
                        </p>
                        <p class="info-value text-muted text-sm col-8 text-break lh-base">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                        </p>
                    </div>
                    <div class="type-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Type :
                        </p>
                        <p class="info-value  text-muted ms-2 mb-0 text-sm col-8">
                            Plastic
                        </p>
                    </div>
                    <div class="weight-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Kg(s) :
                        </p>
                        <p class="info-value  text-muted ms-2 mb-0 text-sm col-8">
                            10kgs.
                        </p>
                    </div>
                    <div class="price-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Total Amount :
                        </p>
                        <p class="info-value fw-bold text-muted ms-2 mb-0 text-sm col-8">
                            P 200.00
                        </p>
                    </div>
                    <div class="price-wrapper mt-2 d-flex align-items-center mb-3">
                        <p class="address-text fw-bold mb-0 text-sm col-4">
                            Address :
                        </p>
                        <p class="info-value text-muted ms-2 mb-0 text-sm col-8">
                            Urgello Sambag 1 Gozolado Sr.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
        $("#scheduleWrap").addClass('active_nav_item').removeClass('inActive_nav_item');
        $("#dashboardWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#userWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#rfWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#notifWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
    })

    
    
</script>
</html>