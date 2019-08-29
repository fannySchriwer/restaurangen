<?php

include_once '../DBConnection.php';
include_once '../classes/Configuration.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate configuration object/class with database
$configuration = new Configuration($db);

$getConfiguration = $configuration->getConfigurationTable();

$configurationRow = new ConfigurationRow();

$configurationRow->tables = $getConfiguration[0]['tables'];
$configurationRow->sitting_one = $getConfiguration[0]['sitting_one'];
$configurationRow->sitting_two = $getConfiguration[0]['sitting_two'];
$configurationRow->GDPR = $getConfiguration[0]['GDPR'];

echo(json_encode($configurationRow));

echo(json_encode($getConfiguration));
