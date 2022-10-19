<?php 
require '../database.php';

$post_params_field_array = array(
    "suspend_admin_id",//0
  
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
<!-- test -->




<?php
       }else{
       //Form Fields have not been set.
       }
}



$query_push_delete_admin = "UPDATE admin
SET suspend_status  = '1' where admin_id = '".$post_params_field_array_data_value[0]."'";

$query_run = mysqli_query($connection, $query_push_delete_admin);
// header("Location: ../admin_usermanagement.php");
?>