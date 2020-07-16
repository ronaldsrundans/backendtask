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
  
    // products array
    $cards_arr=array();
    $cards_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $card_item=array(
            "id" => $id,
            /*"cardnumber" => $cardnumber,
            "cardseries" => $cardseries,
            "cardperiod" => $cardperiod,
            "dateofissue" => $dateofissue,
            "dateofexpiry" => $dateofexpiry,
            "cardsum" => $cardsum,
            "cardname" => $cardname*/


        );
  
        array_push($cards_arr["records"], $card_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($cards_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No cards were found.")
    );
}
