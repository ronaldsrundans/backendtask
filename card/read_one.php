<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/card.php';
  
$database = new Database();
$db = $database->getConnection();
  
$card = new Card($db);
  
$card->id = isset($_GET['id']) ? $_GET['id'] : die();
  
$card->readOne();
  
if($card->name!=null){
    $card_arr = array(
        "id" =>  $card->id,
        "name" => $card->name,
        "sum" => $card->sum,
        "period" =>  $card->period,
        "issue" => $card->issue,
        "expiry" => $card->expiry,
        "number" =>  $card->number,
        "status" => $card->status
    );
    http_response_code(200);
    echo json_encode($card_arr);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Card id does not exist."));
}
?>
