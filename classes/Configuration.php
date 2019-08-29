<?php
class Configuration {
	private $conn;
	private $table_name = 'configuration';

	public function __construct($db) {
		$this->conn = $db;
	}

	public function getConfigurationTable() {
		$statement = $this->conn->prepare("SELECT * FROM configuration");
			
		$statement->execute([]);

		$configuration = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $configuration;
	}
}

class ConfigurationRow {
	public $tables;
	public $sitting_one;
	public $sitting_two;
	public $GDPR;
}
