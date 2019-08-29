<?php
class Costumer 
{
	private $connection;
	private $table_name = 'costumers';

	public function __construct($db) 
	{
		$this->connection = $db;
	}

	public function createCostumer($customer_row) 
	{
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

class CostumerRow 
{
	public $costumer_ID;
	public $name;
	public $email;
	public $phone;
}
?>
