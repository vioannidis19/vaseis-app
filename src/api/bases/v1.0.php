<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Base.php';
include_once 'get_base_results.php';

function init(): Base {
    $database = new Database();
    $db = $database->getConnection();
    return new Base($db);
}

function getBaseResults($uri) {
    if (isset($uri[6])) http400();
    elseif (isset($uri[5])) {
        if ($uri[4] == "department") {
            getBasesByDept($uri);
        } elseif (isset($_GET['departments'])) {
            getBasesByYearAndMultipleDepts($uri[4], $_GET['departments']);
        }
    } elseif (isset($uri[4])) {
        if (isset($_GET['departments'])) {
            getBasesMultipleDepts($_GET['departments']);
        }
    } else {
        http400();
    }
}

function getBasesByDept($uri) {
    $base = init();
    $stmt = $base->readByDept($uri);
    $baseArray = getResultsV1($stmt);
    echo json_encode($baseArray);
}

function getBasesByYearAndMultipleDepts($year, $depts) {
    $base = init();
    $stmt = $base->readByYearAndMultipleDepts($year, $depts);
    $baseArray = getResultsV1($stmt);
    echo json_encode($baseArray);
}

function getBasesMultipleDepts($depts) {
    $base = init();
    $stmt = $base->readMultipleDepts($depts);
    $baseArray = getResultsV1($stmt);
    echo json_encode($baseArray);
}
