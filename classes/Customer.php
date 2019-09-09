<?php

class Customer {
	private $connection;

	public function __construct($db) {
		$this->connection = $db;
	}

	public function deleteCustomer($customer_ID) {
		$statement = $this->connection->prepare(
			'DELETE
			FROM customers 
			WHERE customer_ID = ?'
		);

		$customer_ID=htmlspecialchars(strip_tags($customer_ID));
		$statement->bindParam(1, $customer_ID);
		
		if($statement->execute()) {
			return true;
		}

		return false;
	}

	public function updateCustomer($customer_row) {
		$statement = $this->connection->prepare(
			"UPDATE customers 
			SET name = :name, 
			email = :email, 
			phone = :phone 
			WHERE customer_ID = :customer_ID");
		
		if($statement->execute(
			[
				":customer_ID" => $customer_row->customer_ID,
				":name" => $customer_row->name,
				":email" => $customer_row->email,
				":phone" => $customer_row->phone		
			]	
		)) {
			return true;
		}

		return false;
	}

	public function createCustomer($customer_row) {
		$statement = $this->connection->prepare(
			'INSERT INTO customers (name, email, phone) 
			VALUES (:name, :email, :phone)'
		);

		// sanitize
		$customer_row->$name = htmlspecialchars(strip_tags($customer_row->$name));
		$customer_row->$email = htmlspecialchars(strip_tags($customer_row->$email));
		$customer_row->$phone = htmlspecialchars(strip_tags($customer_row->$phone));

		$statement->bindParam(':name', $customer_row->name);
		$statement->bindParam(':email', $customer_row->email);
		$statement->bindParam(':phone', $customer_row->phone);
		
		if($statement->execute()) {

			return $this->connection->lastInsertId();
		}
	
		return false;
	}
}

class CustomerRow {
	public $customer_ID;
	public $name;
	public $email;
	public $phone;
}