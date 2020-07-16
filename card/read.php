<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/card.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$card = new Card($db);
  
// read products will be here
// query products
$stmt = $card->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    $cards_arr=array();
    $cards_arr["data"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $card_item=array(
            "id" => $id,
            "cardsum" => $cardsum,
            "cardname" => $cardname

        );
  
        array_push($cards_arr["data"], $card_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($cards_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No cards were found.")
    );
}
