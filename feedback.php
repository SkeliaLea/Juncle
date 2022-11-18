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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Customer Feedback</title>

</head>

    <script>
        function checkUserIsSignedIn() {
            if (localStorage.getItem("username") === null) {
            window.location.href = "index.php";
       
        }else {
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

        <div class="col-3" style="padding-left:50px;">
            <!-- ari imo code -->
            <div class="column-display-wrapper bg-white rounded shadow-sm" style="width: 1000px;">
                <h1 class="section title" style="padding-left: 5px;">Customer Feedback</h1>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center justify-content-between">
                            &nbsp;&nbsp;&nbsp;&nbsp;

                            <!-- SEARCH -->
                            <div class="search-bar-container bg-white d-flex align-items-center p-1 rounded shadow-sm">
                                <img class="search-icon me-1" src="assets/search_icon.svg">
                                <input class="search_field p-0" id="searchBarFilter" type="text" placeholder="Search">
                            </div>
                            <p class="mx-3 mb-0">In</p>
                            <select name="" id="feedbackFilterOption">
                                <option value="feedbackFiLterOption1">Name</option>
                                <option value="feedbackFiLterOption2">Feedback</option>
                                <option value="feedbackFiLterOption3">Status</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="w-100 d-flex align-items-center mt-4">
                        &nbsp;&nbsp;&nbsp;&nbsp;

                        
                        <p class="fw-bold text-sm text-muted mb-0 me-2">Status</p>
                            <div class="vertical-separator mx-3"></div>
                                <ul class="booking-status-filter mb-0 d-inline-flex p-0 ">
                                    <li class="status_filter px-2 mx-2 text-sm status-filter-0">Unread</li>
                                    <li class="status_filter px-2 mx-2 text-sm status-filter-1">Read</li>
                                </ul>
                    </div> -->
            <div id="searchresult" class="mt-4">
                <table class="table table-hover" id="feedbackTable">
                    <thead>
                        <tr>
                            <th scope="col">Feedback ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Feedback</th>
                            <th scope="col">Rating Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "select * from system_feedback inner join user on user.user_id = system_feedback.user_id";
                            $query_run = mysqli_query($connection, $query);       
                                while($row = mysqli_fetch_array($query_run)){
                        ?>
                        <tr>
                            <td><?php echo $row['feedback_id']; ?></td>
                            <td class="feedbackNameValue"><?php echo $row['user_first_name']." ".$row['user_last_name']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td class="feedbackFeedbackValue"><?php echo $row['feedback']; ?></td>
                            <td><?php echo $row['rating_date'];?></td>
                            <td class="feedbackRateValue">
                                <?php 
                                    if($row['status'] == 0) {
                                        echo "Unread";
                                        
                                    } else {
                                        echo "Read";
                                    }         
                                ?>
                           
                            </td>
                            <?php
                                if($row['status'] == 0) {
                                    echo "<td><button class='btn btn-warning markAction' feedbackId='".$row['feedback_id']."'>Mark as read</button></td>";
                                }
                            ?>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
</body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){
        var default_data = $('#searchresult').html();


        $("#searchBarFilter").keyup(function(){
            var filterSelection = $("#feedbackFilterOption :selected").val();
            var input = $(this).val().toUpperCase();

            if(filterSelection == "feedbackFiLterOption1") {
                $(".feedbackNameValue").each(function() {
                    if($(this).text().toUpperCase().includes(input) || input == "") {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                })
            }   
            if(filterSelection == "feedbackFiLterOption2") {
                $(".feedbackFeedbackValue").each(function() {
                    if($(this).text().toUpperCase().includes(input) || input == "") {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                })
            }
            if(filterSelection == "feedbackFiLterOption3") {
                $(".feedbackRateValue").each(function() {
                    if($(this).text().toUpperCase().includes(input) || input == "") {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                })
            }
            
        });
    });

    $("#feedbackFilterOption").change(function() {
        var filterSelection = $("#feedbackFilterOption :selected").val();
        var input = $("#searchBarFilter").val().toUpperCase();
        if(filterSelection == "feedbackFiLterOption1") {
            $(".feedbackNameValue").each(function() {
                if($(this).text().toUpperCase().includes(input) || input == "") {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            })
        }   
        if(filterSelection == "feedbackFiLterOption2") {
            $(".feedbackFeedbackValue").each(function() {
                if($(this).text().toUpperCase().includes(input) || input == "") {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            })
        }
        if(filterSelection == "feedbackFiLterOption3") {
            $(".feedbackRateValue").each(function() {
                if($(this).text().toUpperCase().includes(input) || input == "") {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            })
        }
            
        })

        $(".markAction").click(function() {
            let feedbackId = $(this).attr("feedbackId");
            $.ajax({
                url: "api/api_feedback.php",
                type: "POST",
                data:
                {
                    actionID: 1,
                    feedbackId: feedbackId
                },
                success: function(data)
                {
                    window.location.reload();
                }
            });
        })
    </script>
</html>
