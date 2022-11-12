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
    <title>Scrap Type</title>
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
            <div class="column-display-wrapper bg-white rounded shadow-sm" style="width: 1000px; overflow:hidden; overflow:scroll;">
            <div style="display:flex;">
                <div style ="float:left; flex:80%;">
                <h1 class="section title" style="padding-left: 10px;">Scrap Type</h1>
                </div>
                <div style="text-align:right; padding-right:30px; padding-top:30px; ">
                <button class="btn btn-primary" onclick ="document.getElementById('add_scrap_modal').style.display='block'">+ Add New</button>
                </div>


                <!-- modal -->

                <div class="modal" id="add_scrap_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Scrap</h5>
                            <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('add_scrap_modal').style.display='none'" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="display:flex; padding-left:30px;">
                               
                                    <label>Scrap Name:  </label>
                                    <input type="text" id="name_scrap" class="name_scrap" style="margin-left:30px; border-radius:5px; border-color:gray;">
                                    
                                </div>
                                <br>
                                <div style="display:flex; display:flex; padding-left:30px;">
                               
                               <label>Scrap Price:  </label>
                               <input type="text" id="price_scrap" class ="price_scrap" style="margin-left:37px; border-radius:5px; border-color:gray;">
                               
                           </div>
                           <br>
                           
                           <div style="display:flex; display:flex; padding-left:30px;">
                               
                               <label>Scrap Date:  </label>
                               <input type="date" id="date_scrap" class= "date_scrap" style="margin-left:37px; border-radius:5px; border-color:gray;">
                               
                           </div>
                                <div>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="add_scrap">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="document.getElementById('add_scrap_modal').style.display='none'" >Close</button>
                        </div>
                        </div>
                    </div>
                    </div>


            </div>
            <table class="table table-hover" >
            <thead>
                <tr>
                    <th scope="col">Scrap ID</th>
                    <th scope="col">Scrap Name</th>
                    <th scope="col">Scrap Price</th>
                    <th scope="col">Price Update Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                            $query = "select * from scrap_type";
                             $query_run = mysqli_query($connection, $query);       

                        
                             while($row = mysqli_fetch_array($query_run)){
                              
                          
                            ?>

                <tr>
                    <td><?php echo $row['scrap_id'];?></td>
                    <td><?php echo $row['scrap_name'];?></td>
                    <td><?php echo $row['scrap_price'];?></td>
                    <td><?php echo $row['price_update_date'];?></td>
                    <td>
                    <div class="w3-container">
                            <button data-target="#scrap_type_modal" onclick="display_data('<?php echo $row['scrap_id']?>',
                            '<?php echo $row['scrap_name']?>','<?php echo $row['scrap_price']?>','<?php echo $row['price_update_date']?>')" data-toggle="modal" class="w3-button w3-green">Update Details</button>
                            <div class="modal fade center" id="scrap_type_modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Scrap Type Details</h5>
                                            <button type="button" class="close closeModalButton" data-dismiss="modal">
                                            <span>&times;</span>
                                            </button>
                                        </div>
                                             <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="scrap_id" class="col-form-label">Scrap ID:</label>
                                                        <input type="text" id="scrap_id" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="scrap_name" class="col-form-label">Scrap Name:</label>
                                                        <input type="text" id="scrap_name" disabled>
                                                    </div>
                                                    <div>
                                                        <label for="scrap_price" class="col-form-label">Scrap Price:</label>
                                                        <input type="text" id="scrap_price" disabled>
                                                    </div>
                                                    <div>
                                                        <label for="price_update_date" class="col-form-label">Price Update Date</label>
                                                        <input type="text" id="price_update_date" disabled>
                                                    </div>
                                                 </form>
                                             </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" >Delete</button>
                                                    <button class="btn btn-secondary">Edit</button>
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
                    function display_data(scrap_id, scrap_name, scrap_price, price_update_date){
                        document.getElementById('scrap_id').value = scrap_id;
                        document.getElementById('scrap_name').value = scrap_name;
                        document.getElementById('scrap_price').value = scrap_price;
                        document.getElementById('price_update_date').value = price_update_date;
                    }

                    
                        let btnColDel = document.querySelector('#add_scrap');
                        btnColDel.addEventListener('click', () => {
                           
                            $.ajax({
                                url: 'functions/add_scrap.php',
                                type: 'POST',
                                data: {

                                    scrapname: $("#name_scrap").val(),
                                    scrapprice: $("#price_scrap").val(),
                                    scrapupdatedate: $("#date_scrap").val(),
                                                                                                        
                                },
                                success: function(result) {
                                window.location.href = "admin_scraptype.php";
                                console.log("Successfully added a record.");
                                   
                                                              
                            
                                                                            
                                },
                                error: function(data) {
                                alert("error occured" + data); //===Show Error Message====

                                }

                            });


                        });
                </script>

                
            </tbody>

        
        </div>
        </section>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
</html>