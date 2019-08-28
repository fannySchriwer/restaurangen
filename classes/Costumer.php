<?php
	class Costumer 
	{
		private $connection;
		private $table_name = 'costumers';

		public $name;
		public $email;
		public $phone;

		public function __construct($db) 
		{
			$this->connection = $db;
		}

		public function createCostumer() 
		{
			$statement = $this->connection->prepare(
				"INSERT INTO costumers(name, email, phone) VALUES(:name, :email, :phone)");

			// sanitize
			$this->$name = htmlspecialchars(strip_tags($this->$name));
			$this->$email = htmlspecialchars(strip_tags($this->$email));
			$this->$phone = htmlspecialchars(strip_tags($this->$phone));

			$statement->bindParam(":name", $this->name);
			$statement->bindParam(":email", $this->email);
			$statement->bindParam(":phone", $this->phone);
			
			if($statement->execute()) 
			{
				return true;
			}
		
			return false;
		}
	}

