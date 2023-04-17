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
include_once '../objects/Marque.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$marque = new Marque($db);  
// set ID property of record to read
$marque->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$marque->edit();
  
if($marque->nom_marque!=null){
    // create array
    $marque_arr = array(
        "nom_marque" => $marque->nom_marque,
        "created_at" => $marque->created_at,
        "updatted_at" => $marque->updatted_at
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($marque_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Cette marque n'existe pas"));
}
?>