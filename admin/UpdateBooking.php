<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);

// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

if(!empty($data->costumer_ID) && !empty($data->guests) && !empty($data->sitting)) {

    $booking_row = new BookingRow();
    $booking_row->booking_ID = 1;
    $booking_row->costumer_ID = $data->costumer_ID;
    $booking_row->guests = $data->guests;
    $booking_row->sitting = $data->sitting;

    if($booking->updateBooking($booking_row)) {    
        echo json_encode(array("message" => "Booking was updated."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update booking."));	
    }
} 


?>