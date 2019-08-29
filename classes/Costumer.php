<?php

class Costumer {
	private $connection;
	private $table_name = 'costumers';

	public function __construct($db) {
		$this->connection = $db;
	}

	public function deleteCostumer($costumer_ID) {

		$statement = $this->connection->prepare('DELETE FROM costumers WHERE costumer_ID = :id');
			
		$statement->execute(
			[
				':id' => $costumer_ID
			]
		);

		$count = $statement->rowCount();
		return $count;
	}

	public function updateCostumer($costumer_row) {

		$statement = $this->connection->prepare("UPDATE costumers SET name = :name, email = :email, phone = :phone WHERE costumer_ID = :costumer_ID");

		$statement->execute(
			[
				":costumer_ID" => $costumer_row->costumer_ID,
				":name" => $costumer_row->name,
				":email" => $costumer_row->email,
				":phone" => $costumer_row->phone		
			]
		);

		$count = $statement->rowCount();
		return $count;
	}

	public function createCostumer($customer_row) {
		$statement = $this->connection->prepare(
			"INSERT INTO 
				costumers
				(name, email, phone) 
			VALUES
				(:name, :email, :phone)
			");

		// sanitize
		$customer_row->$name = htmlspecialchars(strip_tags($customer_row->$name));
		$customer_row->$email = htmlspecialchars(strip_tags($customer_row->$email));
		$customer_row->$phone = htmlspecialchars(strip_tags($customer_row->$phone));

		$statement->bindParam(":name", $customer_row->name);
		$statement->bindParam(":email", $customer_row->email);
		$statement->bindParam(":phone", $customer_row->phone);
		
		if($statement->execute()) {
			return $this->connection->lastInsertId();
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
