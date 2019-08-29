<?php
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// Takes raw data from the request
$json = file_get_contents('php://input');
$data = json_decode($json);

$booking_ID = $data->booking_ID;

$booking = new Booking($db);

if($booking->deleteBooking($booking_ID)) {    
    echo json_encode(array("message" => "Booking was deleted."));
}
else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete booking."));	
}

?>