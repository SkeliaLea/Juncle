<?php
session_start();

//----> Database Connection Credentials
require '../database.php';
//LIVE ARRAY TO USE
$post_params_field_array = array(
     "admin_fname",//0
     "admin_lname",//1
     "admin_email",//2
     "admin_username",//3
     "admin_password",//4
     "admin_role",//6
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
</script>





<?php
        }else{
        //Form Fields have not been set.
        }
}



$query_push_new_admin = "insert into admin( admin_first_name, admin_last_name, admin_email, admin_username, admin_password, admin_type, deleted_status, suspend_status) values (
'".$post_params_field_array_data_value[0]."','".$post_params_field_array_data_value[1]."','".$post_params_field_array_data_value[2]."',
'".$post_params_field_array_data_value[3]."', '".$post_params_field_array_data_value[4]."', '".$post_params_field_array_data_value[5]."', '0','0')";

$query_run = mysqli_query($connection, $query_push_new_admin);
header("Location: ../admin_usermanagement.php");




?>