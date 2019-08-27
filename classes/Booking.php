<?php
	class Booking {
		private $conn;
		private $table_name = 'bookings';

		public function __construct($db) {
			$this->conn = $db;
		}

		public function updateBooking($booking) {

			$booking = new BookingRow();
			
            //updates current post in database with new input from user
			$statement = $this->pdo->prepare(
				"UPDATE bookings SET 
				costumer_ID = :costumer_ID,
				guests = :guests, 
				sitting = :sitting, 
				WHERE 
				booking_ID = :booking_ID"
				);
				
            $statement->execute([ 
				":booking_ID" => $booking->booking_ID,
				":costumer_ID" => $booking->costumer_ID,
				":guests" => $booking->guests,
				":sitting" => $booking->sitting
				]);

        	return $statement;
		}
	}

	class BookingRow {
		public $booking_ID;
		public $costumer_ID;
		public $guests;
		public $sitting;
	}
?>