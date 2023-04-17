<?php
// required headers
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    die();
  }
 
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/Marque.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$marque = new Marque($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->nom_marque) 

){
  
    // set product property values
    $marque->nom_marque = $data->nom_marque;
    $marque->created_at = date('Y-m-d H:i:s');
  
    // create the product
    if($marque->save()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Marque ajouter avec success"));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Impossible de creeé une marque."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Impossible de creeé une marquet. Nom de la marque est vide."));
}
?>