<?php

   $conn = new mysqli("localhost",'root', '', "juncle");
   $id = $_POST['id'];
   $location= $_POST['location']; 
   $lattopleft = $_POST['lattopleft'];
   $lngtopleft = $_POST['lngtopleft'];
   $lattopright =  $_POST['lattopright'];
   $lngtopright =  $_POST['lngtopright'];
   $latbottomright = $_POST['latbottomright'];
   $lngbottomright =  $_POST['lngbottomright'];
   $latbottomleft =  $_POST['latbottomleft'];
   $lngbottomleft =  $_POST['lngbottomleft'];

  //  $lattopleft = $_POST["lattopleft"]; 
  //  $lngtopleft = $_POST['lngtopleft'];
  //  $lattopright = $_POST['lattopright']; 
  //  $lngtopright = $_POST['lngtopright']; 
  //  $latbottomright = $_POST['latbottomright']; 
  //  $lngbottomright = $_POST['lngbottomright']; 
  //  $latbottomleft = $_POST['latbottomleft']; 
  //  $lngbottomleft = $_POST['lngbottomleft']; 




   $sql_query = "UPDATE location  SET  location_name = '$location', lat_top_left = $lattopleft, lng_top_left = $lngtopleft,lat_top_right =$lattopright,lng_top_right= $lngtopright,lat_bottom_right = $latbottomright,lng_bottom_right = $lngbottomright, lat_bottom_left = $latbottomleft,lng_bottom_left = $lngbottomleft WHERE location_id = '$id'";
                                           
 
   if(mysqli_query($conn, $sql_query)){
       echo "UPDATED successfully";
       $conn ->close();
     } else {
       echo "Error: " ;
     }
  

    
  
 
  
 

 ?>
 