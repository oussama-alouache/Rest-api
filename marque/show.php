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
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$marque = new Marque($db);
  
// read products will be here
$stmt = $marque->show();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // marque array
    $marque_arr=array();
    // $products_arr[]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $marque_item=array(
            "id" => $id,
            "nom_marque" => $nom_marque,
            "created_at" => html_entity_decode($created_at),
            "updatted_at" => html_entity_decode($updatted_at),
        );
  
        array_push($marque_arr, $marque_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($marque_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Aucune marque trouvé.")
    );
}
?>