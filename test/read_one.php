<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/test.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$test = new Test($db);
  
// set ID property of record to read
$test->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$test->readOne();
  
if($test->testname!=null){
    // create array
    $test_arr = array(
        "id" =>  $test->id,
        "testname" => $test->testname
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($test_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Test row does not exist."));
}
?>
