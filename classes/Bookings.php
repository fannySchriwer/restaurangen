<?php
	class Bookings {
		private $conn;
		private $table_name = 'costumers';

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