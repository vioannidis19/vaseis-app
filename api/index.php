<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Content-Type: application/json; charset=UTF-8");
    $uri = explode("/", trim($_SERVER["REQUEST_URI"], '/'));
    $parameters = count($uri);
    if ($parameters > 2) {
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
        default:
            http_response_code(400);
            echo json_encode(array("message" => "Not Allowed"));
    }
}


