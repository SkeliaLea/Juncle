<?php




$sql_querys = "SELECT * FROM location";

$result_array = array();
$conn = new mysqli("localhost",'root', '', "juncle");
$result = mysqli_query($conn , $sql_querys);

 if($result ->  num_rows > 0 ){
     while ($row =$result -> fetch_assoc()){

        array_push($result_array, $row);
 
     }
    }
    echo json_encode($result_array);
    $conn ->close();
    ?>