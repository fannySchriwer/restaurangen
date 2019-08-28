<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../DBConnection.php';
require_once '../classes/Costumer.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// instantiate costumer object/class with database
$costumer = new Costumer($db);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json); 

if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->phone) 
){
    echo "I got into trying to set the variables!";

    $costumer->name = $data->name;
    $costumer->email = $data->email;
    $costumer->phone = $data->phone;

    if($costumer->createCostumer()) {
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));	
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

echo "I work al the way down here!";
?>
