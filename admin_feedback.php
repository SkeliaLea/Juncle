<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" http-equiv="Content-Type" content="text/html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Juncle « System Feedback</title>
    <link rel="stylesheet" href="/Juncle-main/styles/theme-notification/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/Juncle-main/styles/theme-notification/themes/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/Juncle-main/styles/theme-notification/themes/default/style.css">

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
        <div class="col-10">
        <div class="column-display-wrapper bg-white mx-5 my-2 w-90 p-1 rounded shadow-sm">
            <!-- START -->
            <div id="wrapcontainer">
    	        <div id="container">
            <div id="content">
	        <div class="mtcntnr">
		        <h1 class="module_title">
                <h2>Reports and Feedback</h2>
 
                </div> 
                </h1>
            <div class="mtshad"></div>
            </div>
            <div id="message_container" style="display:none;" class="ui-state-highlight ui-corner-all message_box"> 
                <span style="float: left; margin-right: .1em;" class="ui-icon ui-icon-info"></span>
            </div>
            <div id="main">
                <div class="module_content">

            <div id="notification_list_wrapper">
            <table style="margin: x" summary="Feedback" class="formtable" id="box-table-a">
                <thead>
                    <tr>
                        <th width="10%" scope="col">Rating ID</th>
                        <th width="15%" scope="col">Booking ID</th>
                        <th width="20%" scope="col">Date & Time </th>
                        <th width="20%" scope="col">Rating</th>
                        <th width="20%" scope="col">Feedback</th>
                        <th width="30%" style="text-align:center" scope="col">Action</th>
                    </tr>
                </thead>
            <tbody>
            <tr class="hover-link">
                <td>
                    111111
                </td>
                <td>
                    123456
                </td>
                <td>
                    Insert Date
                </td>
                <td>
                    5 Star                        
                </td>
                <td>
                    Content of Feedback                          
                </td>
                <td>
                    <button id = "gfg" style="padding:0px 7px 0px 5px" class="btn btn-edit-type">View Details</button>                      
                </td>

            </tr>
            
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
</html>