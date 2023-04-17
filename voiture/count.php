<?php
// required headers
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    die();
  }
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/voiture.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$voiture = new Voiture($db);
  
// read products will be here
$stmt = $voiture->show();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
  
    
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($num);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>