<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../../config/database.php';
include_once '../objects/university.php';

$database = new Database();
$db = $database->getConnection();

$university = new University($db);
$university->id = isset($_GET["id"]) ? $_GET["id"] : die();

$university->readOne();

if($university->title != null) {
    $universityArray = array(
        "id" => $university->id,
        "title" => $university->title
    );

    http_response_code(200);
    echo json_encode($universityArray);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Δεν υπάρχει το πανεπιστήμιο."));
}
