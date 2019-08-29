<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes$costumer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$costumer = new Costumer($db);

// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

if(!empty($data->name) && !empty($data->email) && !empty($data->phone)) {

    $costumer_row = new $costumerRow();
    $costumer_row-$costumer_ID = $data->$costumer_ID;
    $costumer_row->name = $data->name;
    $costumer_row->email = $data->email;
    $costumer_row->phone = $data->phone;

    if($costumer->updat$costumer($costumer_row)) {    
        echo json_encode(array("message" => "costumer was updated."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update costumer."));	
    }
} 


?>