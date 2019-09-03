<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require_once '../DBConnection.php';
require_once '../classes/Customer.php';
require_once '../classes/Booking.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

$json = file_get_contents('php://input');
$data = json_decode($json); 

if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->phone) 
) {
    $customer_row = new CustomerRow();

    $customer_row->name = $data->name;
    $customer_row->email = $data->email;
    $customer_row->phone = $data->phone;

    // save the last insert id
    if($lastId = $customer->createCustomer($customer_row)) {
        http_response_code(201);

        $booking = new Booking($db);

        $booking_row = new BookingRow();
        
        // setting the last id/primary key from Customer table as property so it
        // can become foreign key of Bookings table
        $booking_row->customer_ID = $lastId;
        // setting the rest of properties regularly with data from post-req
        $booking_row->guests = $data->guests;
        $booking_row->sitting = $data->sitting;
        
        if ($booking->createBooking($booking_row)) {
            http_response_code(201);
            echo json_encode(array('message' => 'Booking was also created.'));
        }

        echo json_encode(array('message' => 'Customer was created.'));
    }
    else {
        http_response_code(503);
        echo json_encode(array('message' => 'Unable to add customer.'));	
    }
} 
else {
    http_response_code(400);
    echo json_encode(array('message' => 'Unable to add customer. Data is incomplete.'));
}