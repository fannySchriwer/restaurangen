<?php
	include_once '../DBConnection.php';

	class GetBookedTables {
		public $

		public function __construct() {

			$this -> freeBookings();
		}	
		
		public function freeBookings() {
			$statement = $pdo->prepare(
				"SELECT bookings.*, configuration.tables AS tables
				FROM bookings
				JOIN configuration");
				
			$statement->execute([
			]);
			$all_bookings = $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}		
?>