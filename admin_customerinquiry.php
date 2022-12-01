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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Customer Inquiry</title>
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
        
        <div class="col-3" style="padding-left:50px;">
            <!-- ari imo code -->
            <div class="column-display-wrapper bg-white rounded shadow-sm" style="width: 1000px;">
            <h1 class="section title" style="padding-left: 5px;">Customer Inquiry</h1>
            <table class="table table-hover" >
            <thead>
                <tr>
                    <th scope="col">Inquiry No.</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
            $query = "select * from inquiry inner join user on user.user_id = inquiry.user_id";
                             $query_run = mysqli_query($connection, $query);       

                        
                             while($row = mysqli_fetch_array($query_run)){
                              
                          
                            ?>
                <tr>
                    <td><?php echo $row['inquiry_id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['user_first_name']." ".$row['user_last_name']; ?></td>
                    <td><?php echo $row['user_email']; ?></td>
                    <td><?php echo $row['date_created'];?></td>
                    <td>
                    <div class="w3-container">
                            <button data-target="#customer_inquiry_modal" onclick="display_data('<?php echo $row['subject']?>','<?php echo $row['description']?>')" data-toggle="modal" class="w3-button w3-green">View Inquiry</button>
                            <div class="modal fade center" id="customer_inquiry_modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Message</h5>
                                            <button type="button" class="close closeModalButton" data-dismiss="modal">
                                            <span>&times;</span>
                                            </button>
                                        </div>
                                             <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="subject" class="col-form-label">Subject:</label>
                                                        <input type="text" id="subject"  disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text" disabled></textarea>
                                                    </div>
                                                 </form>
                                             </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                    </td>
                </tr>
                <?php 
                             }
                ?>
               <script>
                    function display_data(subject, description){
                        document.getElementById('subject').value = subject;
                        document.getElementById('message-text').value = description;
                    }
                </script>
                </tbody>
            </table>
            </div>
        </div>
        </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
</html>