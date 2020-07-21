<?php
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
require_once '../objects/card.php';

$database = new Database();
$db = $database->getConnection();
$card = new Card($db);
$card->id = isset($_GET['id']) ? $_GET['id'] : die();
if($card->activate()){
    http_response_code(200);
    echo json_encode(array("message" => "Card was activated."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Failed to activate card."));
}
?>