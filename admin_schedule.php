g<?php 
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
    <link rel="stylesheet" href="/styles/mainComponent.css">
    <title>Dashboard</title>
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
                                    <option value="">Pending</option>
                                    <option value="">Approved: Paid</option>
                                    <option value="">Approved: Unpaid</option>
                                    <option value="">Cancelled</option>
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
                                <div class="month-schedule-list">
                                    
                                
                                    <!-- Query Data -->
                       

                                <div class="schedule-record p-3 rounded shadow-sm mb-3">
                                        <div class="card-info">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="trackingNo-wrapper d-flex justify-content-between align-items-center">
                                                    <p class="label-text fw-bold mb-0">
                                                        Tracking Number :
                                                    </p>
                                                    <p class="info-value strong ms-2 mb-0">
                                                   ILISI NI
                                                    </p>
                                                </div>
                                                <img class="search-icon me-1" src="assets/delete_schedule_icon.svg">   
                                            </div>
                                            <div class="d-flex align-items-center mt-1">
                                                <div class="scrap-wrapper d-flex justify-content-between align-items-center">
                                                    <p class="label-text fw-bold mb-0">
                                                        Scrap :
                                                    </p>
                                                    <p class="text-muted ms-2 mb-0">
                                                    ILISI NI
                                                    </p>
                                                </div>
                                                <div class="weigh-wrapper d-flex justify-content-between align-items-center ms-3">
                                                    <p class="label-text fw-bold mb-0">
                                                        Kg(s) :
                                                    </p>
                                                    <p class="text-muted ms-2 mb-0">
                                                    ILISI NI
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="status-wrapper px-2 py-1 shadow-sm">
                                                        <p class="text-muted fw-bold m-0 text-sm">Processing</p>
                                                    </div>
                                                    <p class="text-sm mx-2 m-0 fst-italic">as of</p>
                                                    <p class="text-sm m-0 fst-italic fw-bold">    ILISI NI</p>
                                                </div>
                                                <button class="btn btn-outline-secondary btn-sm">View Record</button>
                                            </div>
                                        </div>
                                    </div>
                     
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