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
}

class CostumerRow {
	public $costumer_ID;
	public $name;
	public $email;
	public $phone;
}

?>