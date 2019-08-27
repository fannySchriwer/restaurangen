<?php
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Booking.php';
 
$id = 6;
// get database connection
$database = new Database();
$db = $database->getConnection();
$booking = new Booking($db);
 
$booking->deleteBooking($id);


?>