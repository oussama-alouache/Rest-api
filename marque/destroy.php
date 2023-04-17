<?php
// required headers
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST,DELETE, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    die();
  }
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Marque.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$marque = new Marque ($db);
  
// set ID property of record to read
$marque->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
if($marque->destroy()){
  
    // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode(array("message" => "Marque supprimé avec success."));
}

  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Aucune marque trouvé."));
}
?>