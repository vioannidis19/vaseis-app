<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" || $_SERVER["REQUEST_METHOD"] === "HEAD") {
    $uri = explode("/", trim($_SERVER["REQUEST_URI"], '/'));
    $parameters = count($uri);
    if ($parameters > 2) {
        header("Content-Type: application/json; charset=UTF-8");
        apiHandler($uri);
    } else {
        include $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/views/api.html';
    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Επιτρέπεται μόνο η χρήση της GET."));
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
        default:
            http_response_code(400);
            echo json_encode(array("error" => "Not allowed"));
    }
}


