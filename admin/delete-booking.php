<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../DBConnection.php';
include_once '../classes/Booking.php';

$database = new Database();
$db = $database->getConnection();
$booking = new Booking($db);

$json = file_get_contents('php://input');
$data = json_decode($json);
var_dump($data);

$booking_ID = $data->booking_ID;

if($booking->deleteBooking($booking_ID, $booking_row, $customer_row)) {
    echo "Success";
}
else {
    echo "No success";
}


