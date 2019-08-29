<?php

class Costumer {
	private $conn;
	private $table_name = 'costumers';

	public function __construct($db) {
		$this->conn = $db;
	}

	public function updateBooking($costumer_row) {

		$sql = "UPDATE costumers SET name = :name, email = :email, phone = :phone WHERE costumer_ID = :costumer_ID";
		$statement = $this->pdo->prepare($sql);
	
		$costumer_row->$name = htmlspecialchars(strip_tags($costumer_row->$name));
		$costumer_row->$email = htmlspecialchars(strip_tags($costumer_row->$email));
		$costumer_row->$phone = htmlspecialchars(strip_tags($costumer_row->$phone));
	
		$statement->bindParam(":name", $costumer_row->name);
		$statement->bindParam(":email", $costumer_row->email);
		$statement->bindParam(":phone", $costumer_row->phone);
					
	
		if($statement->execute()) {
			return true;
		}
	
		return false;
	}
}

class CostumerRow {
	public $costumer_ID;
	public $name;
	public $email;
	public $phone;
}

?>