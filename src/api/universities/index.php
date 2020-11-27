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
    if(isset($uri[3])) getUniversity($uri[3]);
        else getUniversities();
}

function getUniversity($id) {
    $university = init();
//    header("Access-Control-Allow-Origin: *");
//    header("Access-Control-Allow-Headers: access");
//    header("Access-Control-Allow-Methods: GET");
    $university->id = $id;
    $university->readOne();

    if($university->title != null) {
        $universityArray = array(
            "id" => $university->id,
            "title" => $university->title,
            "full-title" => $university->fullTitle
        );

        http_response_code(200);
        echo json_encode($universityArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν υπάρχει πανεπιστήμιο."));
    }
}

function getUniversities() {
    $university = init();
    $stmt = $university->read();
    if(!$stmt) {
        http_response_code(500);
        echo json_encode(array("error" => "Server error"));
        return -1;
    }
    $universityArray = getResults($stmt);
    if (count($universityArray)) {
       http_response_code(200);
       echo json_encode($universityArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν βρέθηκαν πανεπιστήμια."));
    }
}
