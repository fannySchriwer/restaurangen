<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../DBConnection.php';
include_once '../classes/Booking.php';

$database = new Database();
$db = $database->getConnection();

$bookings = new Booking($db);

$json = file_get_contents('php://input');
$data = json_decode($json); 

if(!empty($data->date)) {
	$get_free_bookings = $bookings->getBookedTables($data->date);

	if(!$get_free_bookings == []){
		
		$return_free_bookings = [];

		for($i = 0; $i < count($get_free_bookings); $i++) {
			$booking_row = new BookingRow();
			$booking_row->booking_ID = $get_free_bookings[$i]['booking_ID'];
			$booking_row->customer_ID = $get_free_bookings[$i]['customer_ID'];
			$booking_row->guests = $get_free_bookings[$i]['guests'];
			$booking_row->sitting = $get_free_bookings[$i]['sitting'];

			array_push($return_free_bookings, $booking_row);
		}

		http_response_code(200);
	}
	else {

		http_response_code(204);
	}
}
else {
	
	$return_free_bookings = [];
	http_response_code(400);
}

echo(json_encode($return_free_bookings));