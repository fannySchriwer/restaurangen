<?php
	include_once '../DBConnection.php';
	include_once '../classes/Configuration.php';

	$db = new Database();
	$conn = $db->getConnection();
	$configuration = new Configuration($conn);
	$getConfiguration = $configuration->getBookedTables();

	echo(json_encode($getConfiguration));
?>