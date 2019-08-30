<?php

include_once '../DBConnection.php';
include_once '../classes/Configuration.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate configuration object/class with database
$configuration = new Configuration($db);

$get_configuration = $configuration->getConfigurationTable();

$configuration_row = new ConfigurationRow();

$configuration_row->tables = $get_configuration[0]['tables'];
$configuration_row->sitting_one = $get_configuration[0]['sitting_one'];
$configuration_row->sitting_two = $get_configuration[0]['sitting_two'];
$configuration_row->GDPR = $get_configuration[0]['GDPR'];

echo(json_encode($configuration_row));