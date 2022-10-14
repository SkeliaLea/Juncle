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
    <link rel="stylesheet" href="/styles/mainComponent.css">

	<link rel="stylesheet" href="/Juncle-main/styles/theme-notification/themes/default/style.css">
	<link rel="stylesheet" href="/Juncle-main/styles/theme-notification/bootstrap/bootstrap.min.css">


    <title>Notification</title>
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
        <div class="col-10">
        <div class="column-display-wrapper bg-white mx-5 my-2 w-90 p-3 rounded shadow-sm">
            <!-- START -->
            <div id="wrapcontainer">
    	        <div id="container">
            <div id="content">
	        <div class="mtcntnr">
		        <h1 class="module_title">
                <h2>Notification</h2>
 
                </div> 
                </h1>
            <div class="mtshad"></div>
            </div>
            <div id="message_container" style="display:none;" class="ui-state-highlight ui-corner-all message_box"> 
                <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
                <span class="message"></span><a class="ui-icon ui-icon-close" href="javascript:void(0)" onclick="javascript:$('#message_container').hide()" style="float:right" title="Close"></a>
            </div>
            <div id="main">
                <div class="module_content">

            <div id="notification_list_wrapper">
            <table style="margin:0px" summary="Schedule" class="formtable" id="box-table-a">
                <thead>
                    <tr>
                        <th width="30%" scope="col">Event</th>
                        <th width="40%" scope="col">Description</th>
                        <th width="10%" style="text-align:center" scope="col">Status</th>
                        <th width="20%" style="text-align:center" scope="col">Action</th>
                    </tr>
                </thead>
            <tbody>
            <tr class="hover-link">
            <td>Schedule</td>
                <td>
                    <span class="badge badge-info"></span> Customer(s) that are booking for a schedule.                          
                </td>
                <td style="text-align:center">
                    <span> Seen</span>                      </td>
                <td style="text-align:center">
                    <div class="overlay" style="height: -10px; display: true;">
                    <div id = "gfg2"  title="Schedule">
                        <p>Customer(s) that are booking for a schedule.</p>
                    </div>
                        <button id = "gfg" style="padding:0px 7px 0px 5px" class="btn btn-edit-type"><i class="icon-search"></i>View Details</button>
                
                    </div>
                </td>
            </tr>
            <tr class="hover-link">
            <td>Pick Up</td>
                <td>
                    <span class="badge badge-info"></span> Customer(s) scheduled for pick up.                          
                </td>
                <td style="text-align:center">
                <span> New</span>                      </td>
                <td style="text-align:center">
                <div class="overlay" style="height: -10px; display: true;">
                    <div id = "gfg3"  title="Pick Up">
                        <p> Customer(s) scheduled for pick up.</p>
                    </div>
                        <button id = "gfg1" style="padding:0px 7px 0px 5px" class="btn btn-edit-type"><i class="icon-search"></i>View Details</button>
                
                    </div>
                
                </td>
            </tr>                  
            </table>
            </div><!-- #NOTIFICATION LIST WRAPPER -->

                </div><!-- #MODULE -->
            </div><!-- #MAIN -->
            </div><!-- #CONTENT -->
                </div><!-- #container -->
	        </div><!-- #wrapcontainer -->
        </div>
        </div>
    </section>

</body>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type = "text/javascript">
		$(function() {
			$( "#gfg2" ).dialog({
		        autoOpen: false,
			close: function( event, ui ) {
				console.log('closed')
			},
			});
			$( "#gfg" ).click(function() {
			$( "#gfg2" ).dialog( "open" );
			});

            $( "#gfg3" ).dialog({
		        autoOpen: false,
			close: function( event, ui ) {
				console.log('closed')
			},
			});
			$( "#gfg1" ).click(function() {
			$( "#gfg3" ).dialog( "open" );
			});
		});
	</script>
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

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type = "text/javascript">
		$(function() {
			$( "#gfg2" ).dialog({
		        autoOpen: false,
			close: function( event, ui ) {
				console.log('closed')
			},
			});
			$( "#gfg" ).click(function() {
			$( "#gfg2" ).dialog( "open" );
			});

            $( "#gfg3" ).dialog({
		        autoOpen: false,
			close: function( event, ui ) {
				console.log('closed')
			},
			});
			$( "#gfg1" ).click(function() {
			$( "#gfg3" ).dialog( "open" );
			});
		});
	</script>
</html>