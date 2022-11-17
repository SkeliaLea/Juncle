<?php
session_start();

//----> Database Connection Credentials
require '../database.php';
//LIVE ARRAY TO USE
$post_params_field_array = array(
     "edit_id",//0
     "edit_fname",//1
     "edit_mname",//2
     "edit_lname",//3
     "edit_email",//4
     "edit_address",//5
     "edit_password",//6
     "edit_plate_number",//7,
     "edit_cont_number"
     );
     ?>
<script>
console.log($post_params_field_array);
</script>
<?php
$post_params_field_array_data_value = array();


 for($i = 0;$i < sizeof($post_params_field_array); $i++){
    $post_params_field_string_holder = $post_params_field_array[$i];
    if(isset($_POST[(String)$post_params_field_array[$i]])){
        array_push($post_params_field_array_data_value, $_POST[(String)$post_params_field_array[$i]]);
        // print_r($post_params_field_array_data_value[$i].", "); 
    ?>

<!-- For Console Debugging -->
<script>
console.log("<?php echo $post_params_field_array[$i].' is Set.'; ?>");
console.log('Admin Value: ' + "<?php echo $_POST[(String)$post_params_field_array[$i]]; ?>");
alert($post_params_field_array_data_value[6]);
</script>




<?php
        }else{
        //Form Fields have not been set.
        }
}


$query = "UPDATE collector
SET contact_number = '".$post_params_field_array_data_value[8]."', collector_firstname = '".$post_params_field_array_data_value[1]."', collector_middlename = '".$post_params_field_array_data_value[2]."', collector_lastname = '".$post_params_field_array_data_value[3]."',
collector_email = '".$post_params_field_array_data_value[4]."', collector_address = '".$post_params_field_array_data_value[5]."', password ='".$post_params_field_array_data_value[6]."', plate_number = '".$post_params_field_array_data_value[7]."' WHERE collector_id = '".$post_params_field_array_data_value[0]."';";
$query_run = mysqli_query($connection, $query);
header("Location: ../admin_usermanagement.php");




?>