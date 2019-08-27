<?php
	class Booking {
		private $conn;
		private $table_name = 'bookings';

		public function __construct($db) {
			$this->conn = $db;
		}
	}

	class BookingRow {
		public $booking_ID;
		public $costumer_ID;
		public $guests;
		public $sitting;
	}
?>