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
include_once '../objects/reservation.php';
  
$database = new Database();
$db = $database->getConnection();
  
$reservation = new Reservation($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
if (empty($data->nom)) {
    http_response_code(400);
    echo json_encode(array("message" => "nom vide"));
    
} elseif(empty($data->prenom)) {
    echo json_encode(array("message" => "prenom vide"));

}elseif(empty($data->adresse)) {
    echo json_encode(array("message" => "adresse vide"));

}elseif(empty($data->mail)) {
    echo json_encode(array("message" => "Email vide"));

}elseif(empty($data->phone)) {
    echo json_encode(array("message" => "numero de telephone vide"));
}





// make sure data is not empty
if(

    !empty($data->nom) &&
    !empty($data->prenom) &&
    !empty($data->adresse) &&
    !empty($data->mail) &&
    !empty($data->phone) &&
    !empty($data->id_voiture) 
){
  
    // set product property values
    $reservation->nom = $data->nom;
    $reservation->prenom = $data->prenom;
    $reservation->adresse = $data->adresse;
    $reservation->mail = $data->mail;
    $reservation->phone = $data->phone;
    $reservation->id_voiture = $data->id_voiture;
    $reservation->created_at = date('Y-m-d H:i:s');
  
    // create the product
    if($reservation->save()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => " votre reservation a étais soumise on vous contact dés que possible"));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "merci de réessayer ultérieurement "));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>