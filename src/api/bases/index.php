<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Base.php';
include_once 'get_base_results.php';

function init(): Base
{
    $database = new Database();
    $db = $database->getConnection();
    return new Base($db);
}

function getBasesResults($uri) {

    if (isset($uri[6])) http400();
    elseif (isset($uri[5])) {
        if ($uri[4] == "department") getBasesByYearAndDept($uri[3], $uri[5]);
        else http400();
    }
    elseif (isset($uri[4])) {
        if($uri[3] == 'department') getBasesByDept($uri[4]);
        else http400();
    }
    elseif (isset($uri[3])) {
        if(isset($_GET["year"])) {
            if ($_GET["year"] == "min") {
                getMinYear();
            } elseif ($_GET["year"] == "max") {
                getMaxYear();
            } else {
                http400();
            }
        } else {
            getBasesByYear($uri[3]);
        }
    }
    else http400();
}

function getBasesByYearAndDept($year, $dept) {
    $base = init();
    $stmt = $base->readByYearAndDept($year, $dept);
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
}

function getBasesByYear($year) {
    $base = init();
    $stmt = $base->readByYear($year);
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
}

function getBasesByDept($dept) {
    $base = init();
    $stmt = $base->readByDept($dept);
    if (is_numeric($stmt)) {
        return -1;
    }
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
}

function getMinYear() {
    $base = init();
    $stmt = $base->readMinYear();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    extract($row);
    $baseItem = array(
        "minYear" => $minYear
    );
    echo json_encode($baseItem);
}

function getMaxYear() {
    $base = init();
    $stmt = $base->readMaxYear();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    extract($row);
    $baseItem = array(
        "maxYear" => $maxYear
    );
    echo json_encode($baseItem);
}
