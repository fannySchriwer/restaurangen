<?php
include_once '../DBConnection.php';
include_once '../classes/Booking.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate booking object/class with database
$bookings = new Booking($db);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json); 

if(!empty($data->date)) {
	$getFreeBookings = $bookings->getBookedTables($data->date);

	if(!$getFreeBookings == []){
		
		$returnFreeBookings = [];
		$bookingRow = new BookingRow();

		for($i = 0; $i < count($getFreeBookings); $i++){
			$bookingRow->booking_ID = $getFreeBookings[$i]['booking_ID'];
			$bookingRow->customer_ID = $getFreeBookings[$i]['customer_ID'];
			$bookingRow->guests = $getFreeBookings[$i]['guests'];
			$bookingRow->sitting = $getFreeBookings[$i]['sitting'];

			array_push($returnFreeBookings,$bookingRow);
		}
		http_response_code(200);
	}
	else {
		http_response_code(204);
	}
}
else {
	$returnFreeBookings = null;
	http_response_code(400);
}

echo(json_encode($returnFreeBookings));