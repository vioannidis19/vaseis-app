<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../../config/database.php';
include_once '../objects/university.php';
include_once '../shared/get_uni_results.php';

$database = new Database();
$db = $database->getConnection();

$university = new University($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $university->search($keywords);
$universityArray = getResults($stmt);
echo json_encode($universityArray);

