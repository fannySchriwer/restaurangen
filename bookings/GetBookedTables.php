<?php
	include_once '../DBConnection.php';
	include_once '../classes/Booking.php';

	$date = "2019-08-28";

	$db = new Database();
	$conn = $db->getConnection();
	$freeBookings = new Booking($conn);
	$getFreeBookings = $freeBookings->getBookedTables($date);

	echo(json_encode($getFreeBookings));
?>