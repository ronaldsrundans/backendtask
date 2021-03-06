<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
require_once '../config/database.php';
require_once '../objects/card.php';

$database = new Database();
$db = $database->getConnection();

$card = new Card($db);

$card->id = isset($_GET['id']) ? $_GET['id'] : die();

if($card->expire()){
    http_response_code(200);
    echo json_encode(array("message" => "Card was expired."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Failed to expire card."));
}
?>