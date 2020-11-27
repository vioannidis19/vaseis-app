<?php

require '../../config/database.php';
require '../objects/Base.php';
include_once '../shared/get_base_results.php';

$database = new Database();
$db = $database->getConnection();

$base = new Base($db);

if(isset($_GET["year"]) && isset($_GET["dept"])){
    header("Content-Type: application/json; charset=UTF-8");
    $stmt = $base->readByYearAndDept($_GET["year"], $_GET["dept"]);
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
} elseif(isset($_GET["year"])) {
    header("Content-Type: application/json; charset=UTF-8");
    $stmt = $base->readByYear($_GET["year"]);
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
} elseif(isset($_GET["dept"])) {
    header("Content-Type: application/json; charset=UTF-8");
    $stmt = $base->readByDept($_GET["dept"]);
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
} else {
    header("Content-Type: application/json; charset=UTF-8");
    http_response_code(400);
    echo json_encode(array("error" => "Wrong parameters"));
}
