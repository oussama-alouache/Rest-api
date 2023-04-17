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
include_once '../objects/Voiture.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$voiture = new Voiture($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty

 //   $target_dir = "http://localhost/Rest/image/";
 //   $target_file = $target_dir .$data->image;
  //  $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));





  //   move_uploaded_file($data->image, $target_file);
    
    // set product property values
    $voiture->nom = $data->nom;
    $voiture->id_marque = $data->id_marque;
    $voiture->id_model = $data->id_model;
    $voiture->matricule = $data->matricule;
    $voiture->created_at = date('Y-m-d H:i:s');
    $voiture->km = $data->km;
    $voiture->etat = $data->etat;
  


    
    // create the product
    if($voiture->save()){
  
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

// tell the user data is incomplete

?>