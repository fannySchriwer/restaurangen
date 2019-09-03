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
$booking = new Booking($db);

// Takes raw data from the request
$data = json_decode(file_get_contents('php://input'));
var_dump($data);

$booking_ID = $data->booking_ID;

if($booking->deleteBooking($booking_ID)) {
    echo "Success";
}
else {
    echo "No success";
}


