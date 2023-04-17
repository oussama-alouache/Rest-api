<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$voiture = new Voiture($db);  
// set ID property of record to read
$voiture->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$voiture->edit();
  
if($voiture->name!=null){
    // create array
    $voiture_arr = array(
        "id" =>  $voiture->id,
        "nom" => $voiture->nom,
        "id_marque" => $voiture->id_marque,
        "id_model" => $voiture->id_model,
        "matricule" => $voiture->matricule,
        "created_at" => $voiture->created_at,
        "updatted_at" => $voiture->updatted_at
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($voiture_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>