<?php
// required headers
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, PUT, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    die();
  }
 
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/voiture.php';
  
$database = new Database();
$db = $database->getConnection();
  
$voiture = new Voiture($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty

  
    // set product property values
 
    $voiture->id = $data->id;
    $voiture->nom = $data->nom;
    $voiture->id_marque = $data->id_marque;
    $voiture->id_model = $data->id_model;
    $voiture->matricule = $data->matricule;
    $voiture->updatted_at = date('Y-m-d H:i:s');
    $voiture->km = $data->km;
    $voiture->etat = $data->etat;
  
    // create the product
    if($voiture->update()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }

  
// tell the user data is incomplete

?>