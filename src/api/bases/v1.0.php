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
        } else http400();
    }
}

function getBasesByDept($uri) {
    $base = init();
    $stmt = $base->readByDept($uri);
    $baseArray = getResultsV1($stmt);
    echo json_encode($baseArray);
}
