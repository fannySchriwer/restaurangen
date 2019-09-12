<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
 
include_once '../DBConnection.php';
include_once '../classes/Customer.php';

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);

$json = file_get_contents('php://input');
$data = json_decode($json);

$customer_ID = $data->customer_ID;

if($customer->deleteCustomer($customer_ID)) {

    echo 'Success';
}
else {

    echo 'No success';
}