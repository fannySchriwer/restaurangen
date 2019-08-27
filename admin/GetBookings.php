<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../DBConnection.php';
// include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 

// $product = new Product($db);


?>