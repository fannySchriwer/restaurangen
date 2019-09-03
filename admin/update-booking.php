<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
$database = new Database();
$db = $database->getConnection();

$json = file_get_contents('php://input');
$data = json_decode($json);

if(!empty($data->booking_ID) && !empty($data->customer_ID) && !empty($data->guests) && !empty($data->sitting)) {
    $booking_row = new BookingRow();
    
    $booking_row->booking_ID = $data->booking_ID;
    $booking_row->customer_ID = $data->customer_ID;
    $booking_row->guests = $data->guests;
    $booking_row->sitting = $data->sitting;

    $booking = new Booking($db);

    if($booking->updateBooking($booking_row)) {
        echo json_encode(array('message' => 'Booking was updated successfully'));
    } 
}
else {
    http_response_code(400);
    echo json_encode(array('message' => 'Unable to update booking. Data is incomplete.'));
}
