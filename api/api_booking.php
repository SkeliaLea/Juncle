<?php
    include($_SERVER['DOCUMENT_ROOT'].'/Juncle/database.php');
    $actionID = $_GET['actionID'];

    if($actionID == 1) {
        $bookingId = $_GET['bookingId'];
        
        $getAllBookingDetailsById = "SELECT * FROM `booking`
                                LEFT JOIN `schedule` ON schedule.schedule_id = booking.schedule_id 
                                LEFT JOIN `user` ON user.user_id = booking.user_id
                                LEFT JOIN `invoice`ON invoice.booking_id = booking.booking_id
                                LEFT JOIN `payment` ON payment.invoice_id = invoice.invoice_id
                                LEFT JOIN `rating` ON rating.booking_id = booking.booking_id
                                WHERE booking.booking_id = '".$bookingId."'";
        $executeQuery = mysqli_query($connection, $getAllBookingDetailsById);
        $returnData = mysqli_fetch_assoc($executeQuery);

        $resultArray = array();
        $resultArray['booking_id'] = $returnData['booking_id'];
        $resultArray['user_id'] = $returnData['user_id'];
        $resultArray['schedule_id'] = $returnData['schedule_id'];
        $resultArray['location'] = $returnData['location'];
        $resultArray['landmark'] = $returnData['landmark'];
        $resultArray['booking_status'] = $returnData['booking_status'];
        $resultArray['booking_image'] = $returnData['booking_image'];
        $resultArray['booking_created'] = $returnData['booking_created'];
        $resultArray['booking_modified'] = $returnData['booking_modified'];
        $resultArray['scrap_type'] = $returnData['scrap_type'];
        $resultArray['scrap_weight_est'] = $returnData['scrap_weight_est'];
        $resultArray['description'] = $returnData['Description'];
        $resultArray['schedule_id'] = $returnData['schedule_id'];
        $resultArray['pickup_date'] = $returnData['pickup_date'];
        $resultArray['pickup_area'] = $returnData['pickup_area'];
        $resultArray['user_id'] = $returnData['user_id'];
        $resultArray['user_first_name'] = $returnData['user_first_name'];
        $resultArray['user_last_name'] = $returnData['user_last_name'];
        $resultArray['user_image'] = $returnData['user_image'];
        $resultArray['invoice_id'] = $returnData['invoice_id'];
        $resultArray['service_fee'] = $returnData['service_fee'];
        $resultArray['application_fee'] = $returnData['application_fee'];
        $resultArray['total_amount'] = $returnData['total_amount'];
        $resultArray['tax'] = $returnData['tax'];
        $resultArray['discount'] = $returnData['discount'];
        $resultArray['promo'] = $returnData['promo'];
        $resultArray['net_amount_due'] = $returnData['net_amount_due'];
        $resultArray['payment_id'] = $returnData['payment_id'];
        $resultArray['OR/CR'] = $returnData['OR/CR'];
        $resultArray['date_of_payment'] = $returnData['date_of_payment'];
        $resultArray['rating_id'] = $returnData['rating_id'];
        $resultArray['rating'] = $returnData['rating'];
        $resultArray['feedback'] = $returnData['feedback'];
        $resultArray['rating_date'] = $returnData['rating_date'];

        echo json_encode($resultArray);
    }

    if($actionID == 2) {
        $bookingId = $_GET['bookingId'];
        $resultArray = array();
        $getAllDataFromWeightLedgerByPayment = "SELECT * FROM `weight_ledger` 
                LEFT JOIN `booking` ON weight_ledger.booking_id = booking.booking_id 
                LEFT JOIN `scrap_type` ON scrap_type.scrap_id = weight_ledger.scrap_id 
                WHERE booking.booking_id = '".$bookingId."'";

        $executeQuery = mysqli_query($connection, $getAllDataFromWeightLedgerByPayment);
        $numrows = mysqli_num_rows($executeQuery);
        // $resultSet = mysqli_fetch_assoc($executeQuery);
        
        if($numrows > 0) {
            while($resultSet = mysqli_fetch_assoc($executeQuery)) {
                $resultEntity = array();
                $resultEntity['scrap_name'] = $resultSet['scrap_name'];
                $resultEntity['weight'] = $resultSet['weight'];
                $resultEntity['weight_price'] = $resultSet['weight_price'];
                array_push($resultArray, $resultEntity);
            }
        }

        echo json_encode($resultArray);
    }
?>