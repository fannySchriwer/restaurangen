<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Costumer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// Takes raw data from the request
$json = file_get_contents('php://input');
$data = json_decode($json);

$costumer_row = new costumerRow();

$costumer_row->costumer_ID = $data->costumer_ID;
$costumer_row->name = $data->name;
$costumer_row->email = $data->email;
$costumer_row->phone = $data->phone;

$costumer = new Costumer($db);
$costumer->updateCostumer($costumer_row);

?>