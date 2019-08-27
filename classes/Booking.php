<?php
	class Booking {
		private $conn;
		private $table_name = 'bookings';

		public function __construct($db) {
			$this->conn = $db;
		}

		public function deleteBooking($booking_ID) {
			//selects all posts from db with correct post_id
			$delete_bo<oking = $this->conn->prepare('DELETE FROM bookings WHERE booking_ID = :id');
			
			$deleted = $delete_booking->execute(
				[
					':id' => $booking_ID
				]
			);

		}

	}

	class BookingRow {
		public $booking_ID;
		public $costumer_ID;
		public $guests;
		public $sitting;
	}
?>