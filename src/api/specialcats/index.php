<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/SpecialCategory.php';
require 'get_specialcat_results.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';

function init(): SpecialCategory
{
    $database = new Database();
    $db = $database->getConnection();
    return new SpecialCategory($db);
}

function getSpecialCatResults($uri) {
    if (isset($uri[3])) http400();
    else getSpecialCats();
}

function getSpecialCats() {
    $specialCat = init();
    $stmt = $specialCat->read();
    $specialCatArray = getResults($stmt);
    echo json_encode($specialCatArray);
}
