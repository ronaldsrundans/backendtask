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
$card->series = isset($_GET['series']) ? $_GET['series'] : die();
$card->period = isset($_GET['period']) ? $_GET['period'] : die();
$card->sum = isset($_GET['sum']) ? $_GET['sum'] : die();

//$card->sum = isset($_GET['sum']) ? $_GET['sum'] : die();

// read the details of product to be edited
$card->myFunction();

if($card->name!=null){
    // set response code - 200 OK
    http_response_code(200);

    // make it json format
   // echo json_encode($card_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Card id does not exist."));
}
//echo $card->total;
//echo $card->name;


/*
if($card->name!=null){
    // create array
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

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($card_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Card id does not exist."));
}*/
?>
