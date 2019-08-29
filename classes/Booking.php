<?php
	class Booking {
		private $conn;
		private $table_name = 'bookings';

		public function __construct($db) {
			$this->conn = $db;
		}

		public function getBookings() {
			// select all query
			$bookingToCollect = "SELECT * FROM bookings
				LEFT JOIN costumers
				ON bookings.costumer_ID = costumers.costumer_ID";

			// prepare query statement
			$bookingResults = $this->conn->prepare($bookingToCollect);

			// execute query
			$bookingResults->execute();
			
			$all_bookings = $bookingResults->fetch(PDO::FETCH_ASSOC);

			return $all_bookings;
		}
	}

	class BookingRow {
		public $booking_ID;
		public $costumer_ID;
		public $guests;
		public $sitting;
	}
?>