<?php
	class Booking 
	{
		private $connection;
		private $table_name = 'bookings';

		public $costumer_ID;
		public $guests;
		public $sitting;

		public function __construct($db) 
		{
			$this->connection = $db;
		}

		public function createBooking() 
		{
			$statement = $this->connection->prepare(
				"INSERT INTO 
					bookings
					(costumer_ID, guests, sitting) 
				VALUES
					(:costumer_ID, :guests, :sitting)
				"); 

			// sanitize
			$this->$costumer_ID = htmlspecialchars(strip_tags($this->$costumer_ID));
			$this->$guests = htmlspecialchars(strip_tags($this->$guests));
			$this->$sitting = htmlspecialchars(strip_tags($this->$sitting));

			$statement->bindParam(":costumer_ID", $this->costumer_ID);
			$statement->bindParam(":guests", $this->guests);
			$statement->bindParam(":sitting", $this->sitting);

			if ($statement->execute()) {
				return true;
			}

			return false;
		}
	}
?>