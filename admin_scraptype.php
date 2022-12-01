<?php 
    require 'database.php'; 
    //session_start();
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
                                    <input type="text" id="name_scrap" class="name_scrap" style="margin-left:30px; border-radius:5px; border-color:gray;" maxlength="30">
                                    
                                </div>
                                <br>
                                <div style="display:flex; display:flex; padding-left:30px;">
                               
                               <label>Scrap Price:  </label>
                               <input type="number" id="price_scrap" class ="price_scrap" style="margin-left:37px; border-radius:5px; border-color:gray;" maxlength="3">
                               
                           </div>
                           <br>
                           <div style="display:flex; display:flex; padding-left:30px;">
                               
                               <label>Unit:  </label>
                               <select id="add_unit" name = "add_unit" class ="add_unit" style="margin-left:82px; border-radius:5px; border-color:gray;">

                                                            <option default>per kilo</option>
                                                            <option>per piece</option>
                                            </select> 
                           </div>
                           <br>
                           
                           <div style="display:flex; display:flex; padding-left:30px;">
                               
                               <label>Scrap Date:  </label>
                               <input type="date" id="date_scrap" class= "date_scrap" style="margin-left:37px; border-radius:5px; border-color:gray;">
                               <script language="javascript">
                                                var today = new Date();
                                                var dd = String(today.getDate()).padStart(2, '0');
                                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                                var yyyy = today.getFullYear();

                                                today = yyyy + '-' + mm + '-' + dd;
                                                $('#date_scrap').attr('min',today);
                                                $('#edit-pickup-date').attr('min',today);
                                                
                                                </script>
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
                    <th scope="col">Unit</th>
                    <th scope="col">Price Update Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                            $query = "select * from scrap_type where status ='0'";
                             $query_run = mysqli_query($connection, $query);       

                        
                             while($row = mysqli_fetch_array($query_run)){
                              
                          
                            ?>

                <tr>
                    <td><?php echo $row['scrap_id'];?></td>
                    <td><?php echo $row['scrap_name'];?></td>
                    <td><?php echo $row['scrap_price'];?></td>
                    <td><?php echo $row['units'];?></td>
                    <td><?php echo $row['price_update_date'];?></td>
                    <td>
                    <div class="w3-container">
                            <button data-target="#scrap_type_modal" onclick="display_data('<?php echo $row['scrap_id']?>',
                            '<?php echo $row['scrap_name']?>','<?php echo $row['scrap_price']?>','<?php echo $row['price_update_date']?>', '<?php echo $row['units'];?>')" data-toggle="modal" class="w3-button w3-green">Update Details</button>
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
                                                        <input type="text" id="scrap_id" class ="scrap_id" name ="scrap_id" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="scrap_name" class="col-form-label">Scrap Name:</label>
                                                        <input type="text" id="edit_crap_name" class ="edit_crap_name" name = "edit_crap_name" >
                                                    </div>
                                                    <div>
                                                        <label for="scrap_price" class="col-form-label">Scrap Price:</label>
                                                        <input type="text" id="edit_price_scrap" class ="edit_price_scrap" name ="edit_price_scrap">
                                                    </div>
                                                    <div>
                                                        <label for="scrap_price" class="col-form-label">Unit:</label>
                                                        <select id="edit_unit" name = "edit_unit" class ="edit_unit" style="margin-left:48px;">

                                                            <option value="per kilo" default>per kilo</option>
                                                            <option value ="per piece">per piece</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="price_update_date" class="col-form-label">Price Update Date</label>
                                                        <input type="date" id="edit_price_update_date" class ="edit_price_update_date" name ="edit_price_update_date" >
                                                   
                                                        <script language="javascript">
                                                            var today = new Date();
                                                            var dd = String(today.getDate()).padStart(2, '0');
                                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                                            var yyyy = today.getFullYear();

                                                            today = yyyy + '-' + mm + '-' + dd;
                                                            $('#edit_price_update_date').attr('min',today);
                                                            $('#edit-pickup-date').attr('min',today);
                                                            
                                                        </script>
                                                    </div>
                                                 </form>
                                             </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" onclick ="deletescrap(<?php echo $row['scrap_id']?>)">Delete</button>
                                                    <button class="btn btn-secondary" id ="editscrap" name ="editscrap">Confirm Edit</button>
                                                    <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                </div>

                                               
                                            

                                            </div>
                                        </div>
                                    </div>


                                    
                                    <!-- delete modal -->
                                    <div class="modal" id="deletemodal2" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick ="closehoadelete()" >
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete this user?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" onclick="confirmdeletescrap()">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick ="document.getElementById('deletemodal2').style.display='none';">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                    <!-- end delete modal -->
                                
                                            <script>
                                                     function deletescrap(scrap_id){
                                                        
                                                
                                                    document.getElementById('deletemodal2').style.display='block';
                                                    
                                                    // console.log(delete_id);

                                                    }
                                                    function confirmdeletescrap(){
                                                        var deletescrap = document.getElementById("scrap_id").value;
                                                        $.ajax({
                                                            url: 'functions/delete_scrap.php',
                                                            type: 'POST',
                                                            data: {
                                                                deleteid: deletescrap,
                                                            
                                                                                                                                    
                                                            },
                                                            
                                                            success: function(result) {
                                                            window.location.href = "admin_scraptype.php";
                                                            console.log("Successfully added a record.");
                                                            
                                                                                        
                                                        
                                                                                                        
                                                            },
                                                            error: function(data) {
                                                            alert("error occured" + data); //===Show Error Message====

                                                            }

                                                        });
                                                        

                                                    }
                                                </script>
                    </td>
                </tr>
                

            <?php
            }
                ?>
               <script>

        

                    function display_data(scrap_id, scrap_name, scrap_price, price_update_date, unitscrap){

                        var scrap_unit_options = document.getElementById('edit_unit').options;

                        document.getElementById('scrap_id').value = scrap_id;
                        document.getElementById('edit_crap_name').value = scrap_name;
                        document.getElementById('edit_price_scrap').value = scrap_price;
                        document.getElementById('edit_price_update_date').value = price_update_date;

                        for (let k = 0; scrap_unit_options.length; k++) {
                            if (scrap_unit_options[k].value == unitscrap) {
                                document.getElementById("edit_unit").value = scrap_unit_options[k].value;
                             

                                break;
                            }
                        }
    
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
                                    scrapunit: $("#add_unit").val(),
                                                                                                        
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

                        let editbtn = document.querySelector('#editscrap');
                        editbtn.addEventListener('click', () => {
                            alert($(".edit_price_update_date").val(),);
                            $.ajax({
                                url: 'functions/edit_scrap.php',
                                type: 'POST',
                                data: {
                                    scrapid: $(".scrap_id").val(),
                                    namescrap: $(".edit_crap_name").val(),
                                    pricescrap: $(".edit_price_scrap").val(),
                                    scrapupdatedate: $(".edit_price_update_date").val(),
                                    unitofscrap: $(".edit_unit").val(),
                                                                                                        
                                },
                                
                                success: function(result) {
                                window.location.href = "admin_scraptype.php";
                                console.log(scrapname);
                                console.log(scrapprice);
                                console.log("Successfully added a record.");
                                   
                                                              
                            
                                                                            
                                },
                                error: function(data) {
                                alert("error occured" + data); //===Show Error Message====

                                }

                            });


                        });
                        
                        let deletebtn = document.querySelector('#');
                        deletebtn.addEventListener('click', () => {
                        //    alert($("#price_scrap").val(),);
                            $.ajax({
                                url: 'functions/delete_scrap.php',
                                type: 'POST',
                                data: {
                                    deleteid: $(".scrap_id").val(),
                                   
                                                                                                        
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
        $(document).ready(function() {
            $("#scrapWrap").addClass('active_nav_item').removeClass('inActive_nav_item');
                      $("#userWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#scheduleWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#dashboardWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#rfWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                        $("#notifWrap").addClass('inActive_nav_item').removeClass('active_nav_item');
                    })

</script>
<script>
    document.querySelectorAll('input[type="number"]').forEach(input =>{
        input.oninput = () =>{
            if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
        };
    });
</script>
</html>