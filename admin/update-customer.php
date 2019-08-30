<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../DBConnection.php';
include_once '../classes/Customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// Takes raw data from the request
$json = file_get_contents('php://input');
$data = json_decode($json);

if(!empty($data->customer_ID) && !empty($data->name) && !empty($data->email) && !empty($data->phone)) {
    $customer_row = new CustomerRow();
    
    $customer_row->customer_ID = $data->customer_ID;
    $customer_row->name = $data->name;
    $customer_row->email = $data->email;
    $customer_row->phone = $data->phone;
    
    $customer = new Customer($db);
    
    if($customer->updateCustomer($customer_row)) {
        echo json_encode(array('message' => 'Customer was updated successfully'));
    }

}
else {
    http_response_code(400);
    echo json_encode(array('message' => 'Unable to update customer. Data is incomplete.'));
}
