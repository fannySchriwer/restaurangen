<?php

include_once '../DBConnection.php';
include_once '../classes/Configuration.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate configuration object/class with database
$configuration = new Configuration($db);

$get_configuration = $configuration->getConfigurationTable();

$return_configuration = [];

for($i = 0; $i < count($get_configuration); $i++) {
	$configuration_row = new ConfigurationRow();
	$configuration_row->key = $get_configuration[$i]['config_key'];
	$configuration_row->value = $get_configuration[$i]['value'];

	array_push($return_configuration, $configuration_row);
}

echo(json_encode($return_configuration));