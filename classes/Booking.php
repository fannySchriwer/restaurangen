<?php

class Booking {
	private $connection;
	private $table_name = 'bookings';

	public function __construct($db) {
		$this->connection = $db;
	}

	public function deleteBooking($booking_ID) {

		$delete_booking = $this->connection->prepare("DELETE bookings, costumers FROM bookings INNER JOIN costumers ON bookings.costumer_ID = costumers.costumer_ID WHERE booking_ID = :booking_ID");
		
		$delete_booking->execute(
			[
				":booking_ID" => $booking_ID
			]
		);

		$count = $delete_booking->rowCount();
		echo('Deleted' . ' ' . $count . ' ' . 'rows  in total');

		return $count;

	}

	public function updateBooking($booking_row) {
		
		$statement = $this->connection->prepare(
			"UPDATE bookings SET costumer_ID = :costumer_ID, guests = :guests, sitting = :sitting
			WHERE booking_ID = :booking_ID"
		);				

		$statement->execute(
			[
				":booking_ID" => $booking_row->booking_ID,
				":costumer_ID" => $booking_row->costumer_ID,
				":guests" => $booking_row->guests,
				":sitting" => $booking_row->sitting				
			]
		);

		$count = $statement->rowCount();

		return $count;

	}
}

class BookingRow {
	public $booking_ID;
	public $costumer_ID;
	public $guests;
	public $sitting;
}

?>