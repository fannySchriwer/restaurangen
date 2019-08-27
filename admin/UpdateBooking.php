<?php
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
$id = 6;
// get database connection
$database = new Database();
$db = $database->getConnection();
$booking = new Booking($db);
$booking_row = new BookingRow();

$booking_row->booking_ID = 7;
$booking_row->costumer_ID = 1;
$booking_row->guests = 3;
$booking_row->sitting = '2019-08-28 21:00';


$booking->updateBooking($booking_row);
?>