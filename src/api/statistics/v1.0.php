<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Statistic.php';
include_once 'get_stat_results.php';

function init(): Statistic {
    $database = new Database();
    $db = $database->getConnection();
    return new Statistic($db);
}

function getStatResults($uri) {
    if (isset($uri[5])) {
        if ($uri[4] === 'department') {
            getStatsByDepartment($uri[5]);
        }
    } elseif (isset($_GET["departments"])) {
        getStatsMultipleDeptsV1($_GET["departments"]);
    }
}

function getStatsByDepartment($dept) {
    $stat = init();
    $stmt = $stat->readByDepartmentV1($dept);
    $statArray = getResultsV1($stmt);
    echo json_encode($statArray);
}

function getStatsMultipleDeptsV1($depts) {
    $stat = init();
    $stmt = $stat->readMultipleDepts($depts);
    $statArray = getResultsV1($stmt);
    echo json_encode($statArray);
}
