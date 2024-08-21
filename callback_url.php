<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

 		header("Content-Type: application/json");

     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
 
     // DATA
     $mpesaResponse = file_get_contents('php://input');
 
     // log the response
     $logFile = "M_PESAConfirmationResponse.json";
 
     // write to file
     $log = fopen($logFile, "a");
 
     fwrite($log, $mpesaResponse);
     fclose($log);

     $mpesaResponse = file_get_contents('M_PESAConfirmationResponse.json');
     $callbackContent = json_decode($mpesaResponse);

     $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
     $CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
     $Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->value;
     $MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->value;
     $PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->value;
     $formatedPhone = str_replace("254", "0", $PhoneNumber);
     error_log(print_r($callbackContent, true));


   if($Resultcode == 0) {
    $conn = mysqli_connect("sql5.freesqldatabase.com", "sql5726945", "UIEGnP4mm3", "sql5726945");
    if($conn == false) {
        die("Connection Error: " . mysqli_connect_error());
    } else {
        // Prepare the insert statement with proper column names and values
        $stmt = $conn->prepare("INSERT INTO payment (CheckoutRequestID, ResultCode, amount, MpesaReceiptNumber, PhoneNumber) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $CheckoutRequestID, $Resultcode, $Amount, $MpesaReceiptNumber, $formatedPhone);

        if ($stmt->execute()) {
            // Log success
        } else {
            // Log error
            error_log("Database Insertion Error: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }
}





?>
