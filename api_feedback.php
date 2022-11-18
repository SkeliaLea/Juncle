<?php
    include($_SERVER['DOCUMENT_ROOT'].'/Juncle/database.php');

    $actionType = $_POST['actionID'];
    
    if($actionType == 1) {
        $feedbackId = $_POST['feedbackId'];
        $updateFeedbackStatus = "UPDATE system_feedback SET status = 1 WHERE feedback_id = '".$feedbackId."'";
        mysqli_query($connection, $updateFeedbackStatus);
    }

?>