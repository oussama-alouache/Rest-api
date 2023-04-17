<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/voiture.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$voiture = new Voiture($db);
  
// set ID property of record to read
$voiture->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
if($voiture->destroy()){
  
    // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode(array("message" => "Product was created."));
}

  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>