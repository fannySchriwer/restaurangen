<?php
	class Costumer {
		private $conn;
		private $table_name = 'costumers';

		public function __construct($db) {
			$this->conn = $db;
		}
	}

	class CostumerRow {
		public $costumer_ID;
		public $name;
		public $email;
		public $phone;
	}
?>