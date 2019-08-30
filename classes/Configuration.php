<?php

class Configuration {
	private $connection;

	public function __construct($db) {
		$this->connection = $db;
	}

	public function getConfigurationTable() {
		$statement = $this->connection->prepare('
			SELECT * FROM configuration'
		);
			
		$statement->execute([]);

		$configuration = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $configuration;
	}
}

class ConfigurationRow {
	public $key;
	public $value;
}