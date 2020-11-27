<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/SpecialCategory.php';
require 'get_specialcat_results.php';

function init() {
    $database = new Database();
    $db = $database->getConnection();
    return new SpecialCategory($db);
}

function getSpecialCatResults($uri) {
    getSpecialCats();
}

function getSpecialCats() {
    $specialCat = init();
    $stmt = $specialCat->read();
    $specialCatArray = getResults($stmt);
    if (count($specialCatArray)) {
        http_response_code(200);
        echo json_encode($specialCatArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν βρέθηκαν ειδικές κατηγορίες."));
    }
}
