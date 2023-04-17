<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/database.php';
include_once '../objects/voiture.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$voiture = new Voiture($db);
  
// read products will be here
$stmt = $voiture->show();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $voiture_arr=array();
    // $products_arr[]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $voiture_item=array(
            "id" => $id,
            "nom" => $nom,
            "id_marque" => html_entity_decode($id_marque),
            "id_model" => $price,
            "matricule" => html_entity_decode($matricule),
            "category_id" => $category_id,
            "category_name" => $category_name
        );
  
        array_push($voiture_arr, $voiture_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($voiture_arr);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>