<?php
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';
if ($_SERVER["REQUEST_METHOD"] === "GET" || $_SERVER["REQUEST_METHOD"] === "HEAD" || $_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    $uri = explode("/", trim($_SERVER["REQUEST_URI"], '/'));
    $parameters = count($uri);
    if ($parameters > 2) {
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        apiHandler($uri);
    } else {
        include $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/views/api.php';
    }
} else {
    http405();
}

function apiHandler($uri) {
    $category = $uri[2];
    switch ($category) {
        case 'universities':
            require '../src/api/universities/index.php';
            getUniResults($uri);
            break;
        case 'bases':
            require '../src/api/bases/index.php';
            getBasesResults($uri);
            break;
        case 'departments':
            require '../src/api/depts/index.php';
            getDeptResults($uri);
            break;
        case 'examtypes':
            require '../src/api/examtypes/index.php';
            getExamTypeResults($uri);
            break;
        case 'specialcategories':
            require '../src/api/specialcats/index.php';
            getSpecialCatResults($uri);
            break;
        case 'statistics':
            require '../src/api/statistics/index.php';
            getStatResults($uri);
            break;
        case 'v1.0':
            v1ApiHandler($uri);
            break;
        default:
            http400();
    }
}

function v1ApiHandler($uri) {
    $category = $uri[3];
    switch ($category) {
        case 'bases':
            require '../src/api/bases/v1.0.php';
            getBaseResults($uri);
            break;
        default:
            http400();
    }
}


