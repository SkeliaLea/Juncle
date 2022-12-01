<?php
    require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Juncle</title>


</head>

<body>
   
    <div class ="container" style="display:flex;" >
    <div style= "width:70%;">
    <center>
    <img style ="width:30%; padding-top: 8%; "src="assets/logo.png">
    <h1 class="logotext" >Juncle</h1>
    <br>
    <h4 class ="undertext">Recycle Today for Better Tomorrow</h4>
</center>
</div>

    <div style="">
<div style="padding-top:70px;">
    <div class="shadow p-3 mb-5 bg-body rounded""><center>
         <p style="padding-top:15%;font-size: 20px; color:#A4A6B3">Juncle</p>
         <br>
         <h3 style="font-size: 20px;font-family: Arial; text-align: center; letter-spacing: 0.3px;" >Log In to Dashboard</h3>
        <p style = "color: #9FA2B4;font-size: 11px;text-align: center; letter-spacing: 0.2px;">Enter your Username and Pzassword below</p>


        <div class="results_container">
            <p style ="color:red;" class="result_display" id="result_display"> </p>
        </div>
         <form class="login_form" method="post">
            <div>
            <label style="float:left;text-transform: uppercase; font-weight: 700;font-size: 12px;line-height: 15px;color: #9FA2B4;">Username </label>
            <br>
            <input type="text" style="float:left;padding-left:15px;" class="inputbox" id ="username" name="username" placeholder="Username">

            </div>
            <br>
            <br>
          
            <div>
            <label style="float:left;text-transform: uppercase; font-weight: 700;font-size: 12px;line-height: 15px;color: #9FA2B4;">Password:</label>
            <label style="float:right;letter-spacing: 0.1px;color: #9FA2B4;font-size: 10px;line-height: 13px;font-weight: 400;">forgot password</label>
            <br>
            <input type="password" style="float:left;padding-left:15px;" class="inputbox" name ="password" id="password" placeholder="Password">
        
            <input type="button" class="button" id="submitbutton" name="submitbutton" value="Login" style="margin-top:30px;border:none">
        </div>
        <br>
        <p class="donthave">Don’t have an account? <label style="color:#3751FF;">Sign up</label></p>

        
        </form>
        <div>
        <!-- end div box -->
</div>
<!-- end container -->


</body>
<!-- javascript -->
<script>
$(document).ready(function() {
    $("#submitbutton").click(function() {
        
        if ($("#username").val() == "") {
           
            $("#result_display").html("Your username is empty.");
        } else if ($("#password").val() == "") {
            $("#result_display").html("Your password is empty.");
        }else {
            $.ajax({
                url: 'functions/authenticate_user.php',
                type: 'post',
                data: {
                    username: $("#username").val(),
                    password: $("#password").val(),
                },
                success: function(result) {
                    if (result.toString() == "") {
                        $("#result_display").html("Invalid credentials. Please try again.");
                        alert("Invalid Credentials")
                    } else {

                        $("#result_display").html(result.toString());
                        
                    }

                }
            });
        }

    });
});

</script>
</html>
