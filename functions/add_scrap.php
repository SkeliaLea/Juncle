<?php 
require '../database.php';

$post_params_field_array = array(
    "scrapname",//0
    "scrapprice", //1
    "scrapupdatedate",//2
    "scrapunit"
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



$query_push_scrap = "insert into scrap_type(scrap_name, scrap_price, price_update_date, units) values ('".$post_params_field_array_data_value[0]. "', '".$post_params_field_array_data_value[1]."', '".$post_params_field_array_data_value[2]."', '".$post_params_field_array_data_value[3]."')";

$query_run = mysqli_query($connection, $query_push_scrap);
// header("Location: admin_scraptype.php");
// header("Refresh:0; url=admin_scraptype.php");
?>