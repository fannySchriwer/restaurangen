<?php 

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');

include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);
$booking_results = $booking->getBookings();

// check if records exist
if(!isset ($booking_results)) {
    http_response_code(404);
 
    echo json_encode(
        array('message' => 'No bookings found.')
    );
}
else {
    http_response_code(200);
 
    echo json_encode($booking_results);
}