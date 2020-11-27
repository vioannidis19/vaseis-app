<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Base.php';
include_once 'get_base_results.php';

function init() {
    $database = new Database();
    $db = $database->getConnection();
    return new Base($db);
}

function getBasesResults($uri) {
    if (isset($uri[3]) && isset($uri[4]) && isset($uri[5])) {
        getBasesByYearAndDept($uri[3], $uri[5]);
    }
    elseif (isset($uri[3]) && isset($uri[4])) {
        if($uri[3] == 'dept') getBasesByDept($uri[4]);
    }
    elseif (isset($uri[3])) getBasesByYear($uri[3]);
    else {
        http_response_code(400);
        echo json_encode(array("error" => "Λάθος αίτημα."));
    }
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
    $baseArray = getResults($stmt);
    echo json_encode($baseArray);
}
