<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/University.php';
require 'get_uni_results.php';

function init() {
    $database = new Database();
    $db = $database->getConnection();
    return new University($db);
}

function getUniResults($uri) {
    if(isset($uri[4])) http400();
    elseif(isset($uri[3])) getUniversity($uri[3]);
    else getUniversities();
}

function getUniversity($id) {
    $university = init();
    $university->id = $id;
    $university->readOne();

    if($university->title != null) {
        $universityArray = array(
            "id" => $university->id,
            "title" => $university->title,
            "full-title" => $university->fullTitle,
            "isActive" => $university->isActive,
            "logoURL" => $university->logoURL
        );
        http200();
        echo json_encode($universityArray);
    } else {
        echo json_encode(http404());
    }
}

function getUniversities() {
    $university = init();
    $stmt = $university->read();
    if(!$stmt) {
        http500();
        return -1;
    }
    $universityArray = getResults($stmt);
    if (count($universityArray)) {
        http200();
        echo json_encode($universityArray);
    } else {
        echo json_encode(http404());
    }
}
