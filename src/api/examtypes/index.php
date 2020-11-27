<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/ExamType.php';
require 'get_examtype_results.php';

function init() {
    $database = new Database();
    $db = $database->getConnection();
    return new ExamType($db);
}

function getExamTypeResults($uri) {
    getExamTypes();
}

function getExamTypes() {
    $examType = init();
    $stmt = $examType->read();
    $examTypeArray = getResults($stmt);
    if (count($examTypeArray)) {
        http_response_code(200);
        echo json_encode($examTypeArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν βρέθηκαν τύποι εξέτασης."));
    }
}
