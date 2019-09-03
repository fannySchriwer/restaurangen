<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../DBConnection.php';
include_once '../classes/Customer.php';
 
$database = new Database();
$db = $database->getConnection();

$json = file_get_contents('php://input');
$data = json_decode($json);

$customer_row = new CustomerRow();

$customer_row->customer_ID = $data->customer_ID;
$customer_row->name = $data->name;
$customer_row->email = $data->email;
$customer_row->phone = $data->phone;

$customer = new Customer($db);
$customer->updateCustomer($customer_row);