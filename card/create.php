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
$card->series = isset($_GET['series']) ? $_GET['series'] : die();
$card->period = isset($_GET['period']) ? $_GET['period'] : die();
$card->sum = isset($_GET['sum']) ? $_GET['sum'] : die();

$card->create();

if($card->name!=null){
    http_response_code(200);
    echo json_encode(array("message" => "New card added to DB."));
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "Failed to create new card."));
}
?>
