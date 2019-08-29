<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// ==== måste headers ha dubbla ""

include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);
$bookingResults = $booking->getBookings();

// check if records exist
if(!isset ($bookingResults)) {
    http_response_code(404);
 
    echo json_encode(
        array("message" => "No products found.")
    );
}
else {
    http_response_code(200);
 
    echo json_encode($bookingResults);
}