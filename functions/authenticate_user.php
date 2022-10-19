<?php
session_start();
//----> Database Connection Credentials
require '../database.php';



//-----> Form Data

$Username = "";
$Password = "";

if(isset($_POST['username']) AND isset($_POST['password'])){
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    
}else{
    echo "No credentials submitted.";
    ?>
<!-- <meta http-equiv="refresh" content="0; url=../index.php" /> -->
<?php
}



$query = "select * from admin";
$run_query = mysqli_query($connection,$query);
$return_request_from_run_query = mysqli_num_rows($run_query) > 0;

while($row = mysqli_fetch_array($run_query)){
    // echo $row['first_name'];
    if($Username == $row['admin_username'] AND $Password == $row['admin_password']){
        echo "Logging in...";
    
    $_SESSION["username"] = $row['admin_username'];
    
    ?>
    <meta http-equiv="refresh" content="0; url=admin_schedule.php" />
<script>
//LocalStorage Data for User Credentials
localStorage.setItem("username", "<?php echo $row['admin_username']?>");

// localStorage.setItem("admin_status", "<?php //echo $row['account_status']?>");
</script>

<?php
break;
    }else{?>

        </script>Invalid Credentials. Please try again!</script>
    <?php
    }
}

// if(){

// }
?>
