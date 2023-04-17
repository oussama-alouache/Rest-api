<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/reservation.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$reservation = new Reservation($db);  
// set ID property of record to read
$reservation->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$reservation->edit();
  
if($reservation->id_user!=null){
    // create array
    $reservatione_arr = array(
        "id_user" => $reservation->id_user,
        "id_voiture" => $reservation->id_voiture,
        "nom" => $reservation->nom,
        "matricule" => $reservation->matricule,
        "created_at" => $reservation->created_at,
        "updatted_at" => $reservation->updatted_at
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($reservatione_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>