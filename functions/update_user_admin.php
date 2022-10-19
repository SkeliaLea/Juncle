<?php
session_start();

//----> Database Connection Credentials
require '../database.php';
//LIVE ARRAY TO USE
$post_params_field_array = array(
     "edit_admin_fname",//0
     "edit_admin_lname",//1
     "edit_admin_email",//2
     "edit_admin_username",//3
     "edit_admin_password",//4
     "edit_admin_role",//5
     "edit_admin_id"//6
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





$query = "UPDATE admin
SET admin_first_name = '".$post_params_field_array_data_value[0]."', admin_last_name = '".$post_params_field_array_data_value[1]."',
admin_email = '".$post_params_field_array_data_value[2]."', admin_username = '".$post_params_field_array_data_value[3]."', admin_password ='".$post_params_field_array_data_value[4]."',
admin_type = '".$post_params_field_array_data_value[5]."' WHERE admin_id = '".$post_params_field_array_data_value[6]."';";
$query_run = mysqli_query($connection, $query);
// header("Location: ../admin_usermanagement.php");




?>