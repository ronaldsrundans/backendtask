<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../objects/card.php';
  
$database = new Database();
$db = $database->getConnection();

$card = new Card($db);

$stmt = $card->list();
$num = $stmt->rowCount();

if($num>0){
  
    $cards_arr=array();
    $cards_arr["data"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $card_item=array(
            "id" => $id,
            "sum" => $sum,
            "number" => $number,
            "name" => $name,
            "series" => $series,
            "issue" => $issue,
            "expiry" => $expiry,
            "period" => $period
        );
        array_push($cards_arr["data"], $card_item);
    }
    http_response_code(200);
    echo json_encode($cards_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No cards were found.")
    );
}
