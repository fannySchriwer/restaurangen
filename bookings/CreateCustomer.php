<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../DBConnection.php';
require_once '../classes/Costumer.php';
require_once '../classes/Booking.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate costumer object/class with database
$costumer = new Costumer($db);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json); 

if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->phone) 
){
    // TODO: remove
    echo "I got into trying to set the variables!";

    $costumer->name = $data->name;
    $costumer->email = $data->email;
    $costumer->phone = $data->phone;

    // save the last insert id
    if($lastId = $costumer->createCostumer()) {
        http_response_code(201);

        //TODO: remove
        echo $lastId;

        $booking = new Booking($db);

        $booking_row = new BookingRow();
        
        // setting the last id/primary key from Customer table as property so it
        // can become foreign key of Bookings table
        $booking_row->costumer_ID = 4;
        // setting the rest of properties regularly with data from post-req
        $booking_row->guests = $data->guests;
        $booking_row->sitting = $data->sitting;
        
        if ($booking->createBooking($booking_row)) {
               echo json_encode(array("message" => "Booking was also created."));
        }

        echo json_encode(array("message" => "Customer was created."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to add customer."));	
    }
} 
else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to add customer. Data is incomplete."));
}

//TODO: remove
echo "I work al the way down here!";
?>
