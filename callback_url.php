<?php
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

    if($Resultcode == 0){

        $conn = mysqli_connect("sql5.freesqldatabase.com", "sql5726945", "UIEGnP4mm3", "sql5726945");
 if($conn == false) {
    die("Connection Error". mysqli_connect_error());
  }
 else{

        $insert = $conn->query("INSERT INTO payment(CheckoutRequestID, ResultCode, amount, MpesaReceiptNumber, PhoneNumber)");
         $conn = null;
 }
    }

echo $response;



?>
