<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../objects/university.php';
include_once '../shared/get_uni_results.php';

$database = new Database();
$db = $database->getConnection();

$university = new University($db);

$stmt = $university->read();
$universityArray = getResults($stmt);
echo json_encode($universityArray);
