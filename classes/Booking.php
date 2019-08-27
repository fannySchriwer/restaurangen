<?php
	class Booking {
		private $conn;
		private $table_name = 'bookings';

		public function __construct($db) {
			$this->conn = $db;
		}

		public function getBookedTables($date) {
			$statement = $this->conn->prepare(
				"SELECT bookings.*, booking_ID
				FROM bookings
                WHERE DATE(bookings.sitting) = :date ");
				
			$statement->execute([
				':date' => $date
			]);
			$all_bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

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