<?php
	class Configuration {
		private $conn;
		private $table_name = 'configuration';

		public function __construct($db) {
			$this->conn = $db;
		}
	}

	class ConfigurationRow {
		public $tables;
		public $sitting_one;
		public $sitting_two;
		public $GDPR;
	}
?>