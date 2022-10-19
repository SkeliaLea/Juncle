<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/mainComponent.css">
    <title>Document</title>
</head>
<body>
    <section class="navbar_section" style="height:1000px;">
        <div class="w-100 nav_bar mt-4" id="nav_bar">
            <ul class="nav_items_wrapper p-0">
                <li class="nav_item" id="dashboardWrap">
                    <a href="" class="nav-link">
                        <div class="nav-item-content d-flex align-items-center ps-2">
                            <i class="bi bi-bar-chart-line"></i><p class="ms-3 mb-0">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav_item" id="scheduleWrap">
                    <a href="../Juncle/admin_schedule.php  " class="nav-link">
                        <div class="nav-item-content d-flex align-items-center ps-2">
                            <i class="bi bi-calendar-week"></i><p class="ms-3 mb-0">Schedule</p>
                        </div>
                    </a>
                </li>
                <li class="nav_item" id="userWrap">
                    <a href="" class="nav-link" >
                        <div class="nav-item-content d-flex align-items-center ps-2">
                            <i class="bi bi-people"></i><p id="sample" class="sample ms-3 mb-0">User Management</p>
                        </div>
                    </a>
                </li>
                <li class="nav_item" id="rfWrap">
                    <a href="" class="nav-link">
                        <div class="nav-item-content d-flex align-items-center ps-2">
                            <i class="bi bi-flag"></i><p class="ms-3 mb-0">Report and Feedback</p>
                        </div>
                    </a>
                </li>
                <li class="nav_item" id="notifWrap">
                    <a href="" class="nav-link">
                        <div class="nav-item-content d-flex align-items-center ps-2">
                            <i class="bi bi-bell"></i><p class="ms-3 mb-0">Notification</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    
    // set nav item background on click
    $(document).ready(function(){
        $("#dashboardWrap").click(function(){
            $(this).addClass('active_nav_item').removeClass('inActive_nav_item');
        })
    }) 
    
</script>
</html>