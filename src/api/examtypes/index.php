<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/ExamType.php';
require 'get_examtype_results.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';

function init(): ExamType
{
    $database = new Database();
    $db = $database->getConnection();
    return new ExamType($db);
}

function getExamTypeResults($uri) {
    if(isset($uri[3])) http400();
    else getExamTypes();
}

function getExamTypes() {
    $examType = init();
    $stmt = $examType->read();
    $examTypeArray = getResults($stmt);
    echo json_encode($examTypeArray);
}
