<?php 
require '../database.php';

$post_params_field_array = array(
    "namescrap",//0
    "pricescrap", //1
    "scrapupdatedatee",//2
    "scrapid",//3
    "unitofscrap"//4
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
<?php
       }else{
       //Form Fields have not been set.
       }
}



$query_push_scrap = "UPDATE scrap_type set units = '".$post_params_field_array_data_value[4]."', scrap_name = '".$post_params_field_array_data_value[0]."', scrap_price = '".$post_params_field_array_data_value[1]."', price_update_date = CURDATE() where scrap_id ='".$post_params_field_array_data_value[3]."' ";

$query_run = mysqli_query($connection, $query_push_scrap);
// header("Location: admin_scraptype.php");
// header("Refresh:0; url=admin_scraptype.php");
?>