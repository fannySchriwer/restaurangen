<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// Takes raw data from the request
$data = json_decode(file_get_contents('php://input'));

if(!empty($data->booking_ID)) {
    $booking_ID = $data->booking_ID;
    
    $booking = new Booking($db);

    if($booking->deleteBooking($booking_ID)) {
        echo json_encode(array('message' => 'Booking was successfully deleted'));
    }
}
else {
    http_response_code(400);
    echo json_encode(array('message' => 'Unable to delete booking. Data is incomplete.'));
}
