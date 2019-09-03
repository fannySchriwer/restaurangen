<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../DBConnection.php';
include_once '../classes/Booking.php';

$database = new Database();
$db = $database->getConnection();

$json = file_get_contents('php://input');
$data = json_decode($json);

if(!empty($data->booking_ID)) {
    $booking_ID = $data->booking_ID;
    var_dump($booking_ID);
    
    $booking = new Booking($db);
    // $booking->booking_ID = $data->booking_ID;

    if($booking->deleteBooking($booking_ID)) {
        echo json_encode(array('message' => 'Booking and customer was deleted successfully'));
    }
}
else {
    http_response_code(400);
    echo json_encode(array('message' => 'Unable to delete booking. Data is incomplete.'));
}
