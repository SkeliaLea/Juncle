<?php
    include('database.php');

    // Constants
    $BOOKING_STATUS_PENDING_INT = 1;                     // DB value of "Pending" booking status
    $BOOKING_STATUS_PROCESSING_INT = 2;                  // DB value of "Processing" booking status
    $BOOKING_STATUS_FOR_PAYMENT_INT = 3;                 // DB value of "For Payment" booking status
    $BOOKING_STATUS_DONE_INT = 4;                        // DB value of "Done" booking status
    $BOOKING_STATUS_REJECTED_INT = 5;                    // DB value of "Rejected" booking status

    $BOOKING_STATUS_PENDING_STRING = "Pending";          // Waiting for approval or rejection from collector 
    $BOOKING_STATUS_PROCESSING_STRING = "Processing";    // Approved booking, commit schedule
    $BOOKING_STATUS_FOR_PAYMENT_STRING = "For Payment";  // successful scrap-junkshop trading, return money to the seller
    $BOOKING_STATUS_DONE_STRING = "Done";                // Successfully returned the money to the PM
    $BOOKING_STATUS_REJECTED_STRING = "Rejected";        // rejected bookings
    
    // Functions
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

    function formatTrackingNumber($booking_id) {
        $bookingID = "".$booking_id;
        $prefixTrackingNo = "";

        for($length = 5; $length > strlen($bookingID); $length--) {
            $prefixTrackingNo = $prefixTrackingNo."0";
        }

        return $prefixTrackingNo.$booking_id;
    }

    function formatBookingStatusDisplay($bookingStatus) {
        global $BOOKING_STATUS_PENDING_INT, 
                $BOOKING_STATUS_PROCESSING_INT, 
                $BOOKING_STATUS_FOR_PAYMENT_INT,
                $BOOKING_STATUS_DONE_INT, 
                $BOOKING_STATUS_REJECTED_INT, 
                $BOOKING_STATUS_PENDING_STRING,
                $BOOKING_STATUS_PROCESSING_STRING, 
                $BOOKING_STATUS_FOR_PAYMENT_STRING, 
                $BOOKING_STATUS_DONE_STRING,
                $BOOKING_STATUS_REJECTED_STRING;

        switch($bookingStatus) {
            case $BOOKING_STATUS_PENDING_INT:
                return $BOOKING_STATUS_PENDING_STRING;
            case $BOOKING_STATUS_PROCESSING_INT:
                return $BOOKING_STATUS_PROCESSING_STRING;
            case $BOOKING_STATUS_FOR_PAYMENT_INT:
                return $BOOKING_STATUS_FOR_PAYMENT_STRING;
            case $BOOKING_STATUS_DONE_INT:
                return $BOOKING_STATUS_DONE_STRING;
            case $BOOKING_STATUS_REJECTED_INT: 
                return $BOOKING_STATUS_REJECTED_STRING;
            default:
                return "";
        }
    }

    function formatDateToWord($date) {
        return date("F jS, Y", strtotime($date));
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
    <title>Booking</title>
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
                    <h3>Booking</h3>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="search-bar-container bg-white d-flex align-items-center p-1 rounded shadow-sm">
                                <img class="search-icon me-1" src="assets/search_icon.svg">
                                <input class="search_field p-0" type="text" placeholder="Search">
                            </div>
                            <p class="text-sm text-muted my-0 mx-3">In</p>
                            <select name="" id="" class="p-1 rounded shadow-sm me-3">
                                <option value="">Tracking Number</option>
                                <option value=""></option>
                                <option value="">Amount</option>
                                <option value="">Type</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary btn-sm me-2">Apply filter</button>
                            <button class="btn btn-outline-secondary btn-sm">Reset Filter</button>
                        </div>
                    </div>
                    <div class="w-100 d-flex align-items-center mt-4">
                        <p class="fw-bold text-sm text-muted mb-0 me-2">Status</p>
                        <div class="vertical-separator mx-2"></div>
                        <ul class="booking-status-filter mb-0 d-inline-flex p-0 ">
                            <li class="px-2 mx-2 text-sm status-filter-0">All</li>
                            <li class="px-2 mx-2 text-sm status-filter-1">Pending</li>
                            <li class="px-2 mx-2 text-sm status-filter-2">Processing</li>
                            <li class="px-2 mx-2 text-sm status-filter-3">For Payment</li>
                            <li class="px-2 mx-2 text-sm status-filter-4">Done</li>
                            <li class="px-2 mx-2 text-sm status-filter-5">Rejected</li>
                        </ul>
                    </div>
                    <hr class="mt-3">
                    <div class="scrollbarSchedule pe-2">
                    <div class="schedule-list">
                        <div class="month-separator w-100">
                            <div class="month-schedule-list">
                            <?php
                                $getAllBookingDetails = "SELECT * FROM `booking` A
                                    LEFT JOIN `schedule` B ON B.schedule_id = A.schedule_id 
                                    LEFT JOIN `user`C ON C.user_id = A.user_id";
                                $executeQuery = mysqli_query($connection, $getAllBookingDetails);
                                $getRows = mysqli_num_rows($executeQuery);

                                if($getRows > 0) {
                                    while($bookingEntity = mysqli_fetch_assoc($executeQuery)) {
                                        echo '<div class="schedule-record p-3 rounded shadow-sm mb-3 me-0" bookingId="'.$bookingEntity['booking_id'].'" trackingNo="'.formatTrackingNumber($bookingEntity['booking_id']).'">
                                            <div class="card-info">
                                                <div class="d-flex justify-content-between">
                                                    <div class="booking-user-profile d-flex">
                                                        <div class="mb-4 me-2">
                                                            <img class="user-image me-1" src="'.$bookingEntity['user_image'].'">
                                                        </div>
                                                        <div>
                                                            <p class="fs-7 fw-bold mb-0">'.$bookingEntity['user_first_name']." ".$bookingEntity['user_last_name'].'</p>
                                                            <p class="info-value">created a booking on '.formatDateToWord($bookingEntity['booking_created']).'</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-4">
                                                        <div class="status-wrapper px-2 py-1 shadow-sm">
                                                            <p class="text-muted fw-bold m-0 info-value">'.formatBookingStatusDisplay($bookingEntity['booking_status']).'</p>
                                                        </div>
                                                        <p class="text-sm mx-2 m-0 fst-italic info-value"> since </p>
                                                        <p class="text-sm m-0 fst-italic fw-bold info-value">'.formatDateToWord($bookingEntity['booking_modified']).'</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="trackingNo-wrapper d-flex justify-content-between align-items-center">
                                                        <p class="label-text fw-bold mb-0">
                                                            Tracking Number :
                                                        </p>
                                                        <p class="info-value strong ms-2 mb-0">
                                                            '.formatTrackingNumber($bookingEntity['booking_id']).'
                                                        </p>
                                                    </div> 
                                                    
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="weigh-wrapper d-flex justify-content-between align-items-center me-5">
                                                        <p class="label-text fw-bold mb-0">
                                                            Kg(s) :
                                                        </p>
                                                        <p class=" info-value ms-2 mb-0">
                                                            '.getTotalWeightOfScrapPerBooking($bookingEntity['booking_id'], $connection).'
                                                        </p>
                                                    </div>
                                                    <div class="scrap-wrapper d-flex justify-content-between align-items-center">
                                                        <p class="label-text fw-bold mb-0">
                                                            Scrap :
                                                        </p>
                                                        <p class="ms-2 mb-0 info-value">
                                                            '.$bookingEntity['scrap_type'].'
                                                        </p>
                                                    </div>
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
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <p class="fs-4 text-muted m-0">Content Board</p>
                </div>
                <div class="scrollbarContent pe-3">
                    <h5 class="mt-3 information-group-title">General Information</h5>
                    <div class="trackingNo-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Tracking No :
                        </p>
                        <p class="info-value fw-bold strong ms-2 mb-0 text-sm col-8" id="content_tracking_no">
                            
                        </p>
                    </div>
                    <div class="statusNo-wrapper d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Status :
                        </p>
                        <p class="info-value text-muted ms-2 mb-0 text-sm col-8" id="content_booking_status">
                            
                        </p>
                    </div>
                    <div class="rounded shadow-sm item-image-wrapper my-3">
                        <img src="" alt="" id="booking_image">
                    </div>
                    <div class="creator-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Created by :
                        </p>
                        <p class="info-value text-muted ms-2 mb-0 text-sm col-8" id="content_user_display">
                        </p>
                    </div>
                    <div class="creator-wrapper mt-2 d-flex align-items-center">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Created on :
                        </p>
                        <p class="info-value text-muted ms-2 mb-0 text-sm col-8" id="content_created_display">
                        </p>
                    </div>
                    <div class="price-wrapper mt-2 d-flex align-items-center">
                        <p class="address-text info-value fw-bold mb-0 text-sm col-4">
                            Address :
                        </p>
                        <p class="info-value text-muted ms-2 mb-0 text-sm col-8" id="location">
                        </p>
                    </div>
                    <div class="price-wrapper mt-3 d-flex align-items-center">
                        <p class="schedule-text info-value fw-bold mb-0 text-sm">
                            Collection schedule :
                        </p>
                    </div>
                    <div class=" collection-schedule-wrapper border border-success border-1 bg-white my-2 shadow rounded p-2">
                        <div class="row">
                            <div class="col-6">
                                <p class="w-100 text-center info-value fw-bold mb-2 text-sm mb-2">
                                    Pickup date
                                </p>
                                <p class="w-100 text-center info-value mb-0 text-sm mb-2" id="pickup_date">
                                </p>
                            </div>
                            <div class="col-6 text-center border-start border-2">
                                <p class="info-value w-100 text-center fw-bold mb-2 text-sm mb-2">
                                    Area
                                </p>
                                <p class="w-100 text-center info-value mb-0 text-sm mb-2" id="pickup_area">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="scrap-item-wrapper mt-3 d-flex row">
                        <p class="label-text fw-bold mb-0 text-sm col-4">
                            Description :
                        </p>
                        <p class="info-value text-muted text-sm col-8 text-break lh-base" id="description">
                        </p>
                    </div>

                    <div class="invoice-wrapper">
                        <h5 class="mt-3 w-100 information-group-title">Invoice</h5>
                        <div class="price-wrapper mt-2 d-flex align-items-center">
                            <p class="schedule-text info-value fw-bold mb-0 text-sm">
                                Scrap value :
                            </p>
                        </div>
                        <div class = "weight-ledger-container mt-2 w-100">
                        </div>
                        
                        <div class="price-wrapper mt-2 d-flex align-items-center justify-content-between">
                            <p class="label-text fw-bold mb-0 text-sm col-4">
                                Service fee :
                            </p>
                            <p class="fw-bold info-value ms-2 mb-0 text-sm col-6 text-center" id="service_fee">
                            </p>
                        </div>
                        <div class="price-wrapper mt-2 d-flex align-items-center justify-content-between">
                            <p class="label-text fw-bold mb-0 text-sm col-4">
                                Application fee :
                            </p>
                            <p class="fw-bold ms-2 mb-0 info-value text-sm col-6 text-center" id="application_fee">
                            </p>
                        </div>
                        <div class="price-wrapper mt-2 d-flex align-items-center justify-content-between">
                            <h6 class="label-text fw-bold mb-0 text-sm col-4">
                                Net amount due:
                            </h6>
                            <h6 class="fw-bold ms-2 mb-0 text-sm col-6 text-center" id="net_amount_due">
                            </h6>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    let selectedBookingId = 0;

    const BOOKING_STATUS_PENDING_INT = 1;                     // DB value of "Pending" booking status
    const BOOKING_STATUS_PROCESSING_INT = 2;                  // DB value of "Processing" booking status
    const BOOKING_STATUS_FOR_PAYMENT_INT = 3;                 // DB value of "For Payment" booking status
    const BOOKING_STATUS_DONE_INT = 4;                        // DB value of "Done" booking status
    const BOOKING_STATUS_REJECTED_INT = 5;                    // DB value of "Rejected" booking status

    const BOOKING_STATUS_PENDING_STRING = "Pending";          // Waiting for approval or rejection from collector 
    const BOOKING_STATUS_PROCESSING_STRING = "Processing";    // Approved booking, commit schedule
    const BOOKING_STATUS_FOR_PAYMENT_STRING = "For Payment";  // successful scrap-junkshop trading, return money to the seller
    const BOOKING_STATUS_DONE_STRING = "Done";                // Successfully returned the money to the PM
    const BOOKING_STATUS_REJECTED_STRING = "Rejected";        // rejected bookings
    
    //Highlight booking nav option
    $(document).ready(function() {
        $("#bookingWrap").addClass('active_nav_item').removeClass('inActive_nav_item');
        $("#dashboardWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#userWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#rfWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
        $("#notifWrap").addClass('inActive_nav_item').removeClass('active_nav_item');

        $(".status-filter-0").addClass("selected-status-filter");
        $(".invoice-wrapper").hide();
    })

    //highlight "ALL" status filter; unhighlight others
    $(".status-filter-0").click(function() {
        $(".status-filter-0").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-1").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-2").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-3").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-4").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-5").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //highlight "pending" status filter; unhighlight others
    $(".status-filter-1").click(function() {
        $(".status-filter-1").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-0").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-2").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-3").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-4").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-5").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //highlight "processing" status filter; unhighlight others
    $(".status-filter-2").click(function() {
        $(".status-filter-2").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-1").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-0").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-3").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-4").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-5").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //highlight "for payment" status filter; unhighlight others
    $(".status-filter-3").click(function() {
        $(".status-filter-3").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-1").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-2").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-0").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-4").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-5").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //highlight "done" status filter; unhighlight others
    $(".status-filter-4").click(function() {
        $(".status-filter-4").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-1").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-2").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-3").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-0").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-5").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //highlight "rejected" status filter; unhighlight others
    $(".status-filter-5").click(function() {
        $(".status-filter-5").addClass("selected-status-filter").removeClass("unselected-status-filter");
        $(".status-filter-1").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-2").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-3").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-4").addClass("unselected-status-filter").removeClass("selected-status-filter");
        $(".status-filter-0").addClass("unselected-status-filter").removeClass("selected-status-filter");
    })

    //booking item click listener ; fetch specific bookingdetails by id
    $(".schedule-record").click(function() {
        let bookingId = $(this).attr("bookingId");
        let trackingNo = $(this).attr("trackingNo");
        selectedBookingId = bookingId;
        let aID = 1;

        $("#content_tracking_no").html(trackingNo);

        $.ajax({
                url: "api/api_booking.php",
                type: "GET",
                data:
                {
                    actionID: aID,
                    bookingId: bookingId
                },
                success: function(data)
                {
                    let resultset = JSON.parse(data);
                    populateContentBoard(resultset);
                }
            });
    })

    // populate content board
    function populateContentBoard (data) {
        let creator = "";
        $.map(data, function(value, key) {
            if(document.getElementById(key) != null) {
                document.getElementById(key).innerHTML = value;
            }

            // Content board image display
            if(key === "booking_image" && value != null) {
                $("#booking_image").attr("src", value);
            }
            if(key === "booking_image" && value == null) {
                $("#booking_image").attr("src", "assets/No_Image_Available.svg");
            }

            // Content board status display
            if(key === "booking_status") {
                switch(parseInt(value)) {
                    case BOOKING_STATUS_PENDING_INT :
                        document.getElementById("content_"+key).innerHTML = BOOKING_STATUS_PENDING_STRING;
                        $(".invoice-wrapper").hide();
                        break;
                    case BOOKING_STATUS_PROCESSING_INT :
                        document.getElementById("content_"+key).innerHTML = BOOKING_STATUS_PROCESSING_STRING;
                        $(".invoice-wrapper").show();
                        getWeightLedgerByBookingID();
                        break;
                    case BOOKING_STATUS_FOR_PAYMENT_INT :
                        document.getElementById("content_"+key).innerHTML = BOOKING_STATUS_FOR_PAYMENT_STRING;
                        break;
                    case BOOKING_STATUS_DONE_INT :
                        document.getElementById("content_"+key).innerHTML = BOOKING_STATUS_DONE_STRING;
                        break;
                    case BOOKING_STATUS_REJECTED_INT :
                        document.getElementById("content_"+key).innerHTML = BOOKING_STATUS_REJECTED_STRING;
                        break;
                    default:
                }
            }

            // Set value for booking creator
            if(key === "user_first_name") {
                creator = value;
            }
            if(key === "user_last_name") {
                creator = creator+" "+value;
            }

            // format readable creation date
            if(key === "booking_created") {
                $("#content_created_display").html(new Date(value).toDateString());
            }

            // Set invoice price values
            if(key === "application_fee") {
                document.getElementById(key).innerHTML = "P "+value;
            }
            if(key === "service_fee") {
                document.getElementById(key).innerHTML = "P "+value;
            }
            if(key === "net_amount_due") {
                document.getElementById(key).innerHTML = "P "+value;
            }
        })

        // set creator display value
        $("#content_user_display").html(creator);
    }

    function getWeightLedgerByBookingID() {
        $(".weight-ledger-container").html("");

        let aID = 2;
        $.ajax({
                url: "api/api_booking.php",
                type: "GET",
                data:
                {
                    actionID: aID,
                    bookingId: selectedBookingId
                },
                success: function(data)
                {
                    let resultset = JSON.parse(data);
                    resultset.forEach(function (item) {
                        $(".weight-ledger-container").append(
                            `<div class = "border rounded d-flex align-items-center justify-content-between mb-2">` +
                                `<p class="fw-bold mb-0 info-value text-muted w-25 ms-2">`+item["scrap_name"]+`</p>` +
                                `<div class="w-75 weight-price-display d-flex align-items-center">` +
                                    `<p class="fst-italic info-value text-muted mb-0 w-25">`+item["weight"]+` Kg</p>` +
                                    `<div class="price-wrap w-75 p-2 ms-2 fw-bold rounded info-value text-center">P `+item["weight_price"]+`</div>` +
                                `</div>` +
                            `</div>`
                        );
                    })
                }
            });
    }
    
</script>
</html>