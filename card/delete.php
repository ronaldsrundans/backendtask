<?php
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
require_once '../objects/card.php';

$database = new Database();
$db = $database->getConnection();
$card = new Card($db);
$data = json_decode(file_get_contents("php://input"));
$card->id = $data->id;
if($card->delete()){
    http_response_code(200);
    echo json_encode(array("message" => "The card was deleted."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete card."));
}
?>