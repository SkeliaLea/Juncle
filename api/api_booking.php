<?php
    include($_SERVER['DOCUMENT_ROOT'].'/adminjuncle/Juncle/database.php');
    $actionID = $_POST['actionID'];

    if($actionID == 1) {
        $bookingId = $_POST['bookingId'];
        
        $getAllBookingDetailsById = "SELECT 
                                    booking.booking_id,
                                    user.user_id,
                                    invoice.invoice_id,
                                    pickup_schedule.schedule_id,
                                    location,
                                    landmark,
                                    booking_status,
                                    collector_lastname,
                                    collector_firstname,
                                    collector_image,
                                    booking_image,
                                    booking_created,
                                    booking_modified,
                                    scrap_type,
                                    scrap_weight_est,
                                    description,
                                    pickup_date,
                                    pickup_area,
                                    user_first_name,
                                    user_last_name,
                                    user_image,
                                    service_fee,
                                    application_fee,
                                    total_amount,
                                    tax,
                                    discount,
                                    promo,
                                    net_amount_due,
                                    payment_id,
                                    date_of_payment
                                FROM `booking`
                                LEFT JOIN `pickup_schedule` ON pickup_schedule.schedule_id = booking.schedule_id
                                LEFT JOIN `collector` ON collector.collector_id = pickup_schedule.collector_id
                                LEFT JOIN `user` ON user.user_id = booking.user_id
                                LEFT JOIN `invoice`ON invoice.booking_id = booking.booking_id
                                LEFT JOIN `payment` ON payment.invoice_id = invoice.invoice_id
                                WHERE booking.booking_id = '".$bookingId."'";
        $executeQuery = mysqli_query($connection, $getAllBookingDetailsById);
        $returnData = mysqli_fetch_assoc($executeQuery);

        $resultArray = array();
        $resultArray['booking_id'] = $returnData['booking_id'];
        $resultArray['user_id'] = $returnData['user_id'];
        $resultArray['invoice_id'] = $returnData['invoice_id'];
        $resultArray['schedule_id'] = $returnData['schedule_id'];
        $resultArray['collector_firstname'] = $returnData['collector_firstname'];
        $resultArray['collector_lastname'] = $returnData['collector_lastname'];
        $resultArray['collector_image'] = $returnData['collector_image'];
        $resultArray['location'] = $returnData['location'];
        $resultArray['landmark'] = $returnData['landmark'];
        $resultArray['booking_status'] = $returnData['booking_status'];
        $resultArray['booking_image'] = base64_encode($returnData['booking_image']);
        $resultArray['booking_created'] = $returnData['booking_created'];
        $resultArray['booking_modified'] = $returnData['booking_modified'];
        $resultArray['scrap_type'] = $returnData['scrap_type'];
        $resultArray['scrap_weight_est'] = $returnData['scrap_weight_est'];
        $resultArray['description'] = $returnData['description'];
        $resultArray['pickup_date'] = $returnData['pickup_date'];
        $resultArray['pickup_area'] = $returnData['pickup_area'];
        $resultArray['user_first_name'] = $returnData['user_first_name'];
        $resultArray['user_last_name'] = $returnData['user_last_name'];
        $resultArray['user_image'] = base64_encode($returnData['user_image']);
        $resultArray['service_fee'] = $returnData['service_fee'];
        $resultArray['application_fee'] = $returnData['application_fee'];
        $resultArray['total_amount'] = $returnData['total_amount'];
        $resultArray['tax'] = $returnData['tax'];
        $resultArray['discount'] = $returnData['discount'];
        $resultArray['promo'] = $returnData['promo'];
        $resultArray['net_amount_due'] = $returnData['net_amount_due'];
        $resultArray['payment_id'] = $returnData['payment_id'];
        $resultArray['date_of_payment'] = $returnData['date_of_payment'];
        echo json_encode($resultArray);
    }

    if($actionID == 2) {
        $bookingId = $_POST['bookingId'];
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
                $resultEntity['scrap_price'] = $resultSet['scrap_price'];
                array_push($resultArray, $resultEntity);
            }
        }

        echo json_encode($resultArray);
    }

    if($actionID == 3) {
        $bookingId = $_POST["bookingId"];
        $invoiceId = $_POST["invoiceId"];

        $updateBookingStatus = "UPDATE booking SET booking_status = 3 WHERE booking_id = '".$bookingId."'";
    $updateInvoicePaymentStatus = "UPDATE invoice SET payment_status = 1 WHERE booking_id ='" . $bookingId . "'";
        $insertPayment = "INSERT INTO payment (invoice_id, date_of_payment) VALUES ('".$invoiceId."', now())";

        
        mysqli_query($connection, $updateBookingStatus);
        mysqli_query($connection, $updateInvoicePaymentStatus);
        mysqli_query($connection, $insertPayment);

    }
   
?>