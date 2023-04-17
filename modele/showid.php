<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/Model.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$model = new Model($db);  
// set ID property of record to read
$model->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$model->edit();
  
if($model->nom_model!=null){
    // create array
    $model_arr = array(
        "nom_model" => $model->nom_model,
        "created_at" => $model->created_at,

    
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($model_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(    array("message" => "Aucun type trouvé."));
}
?>