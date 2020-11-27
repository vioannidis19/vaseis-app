<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Department.php';
require 'get_dept_results.php';

function init() {
    $database = new Database();
    $db = $database->getConnection();
    return new Department($db);
}

function getDeptResults($uri) {
    if (isset($uri[4])) getDepartmentsByUni($uri[4]);
    elseif (isset($uri[3])) getDepartment($uri[3]);
    else getDepartments();
}

function getDepartment($id) {
    $dept = init();
    $dept->code = $id;
    $dept->readByCode();
    if ($dept->name != null) {
        $deptArray = array(
            "code" => $dept->code,
            "title" => $dept->name,
            "uni-id" => $dept->uniId
        );
        http_response_code(200);
        echo json_encode($deptArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν υπάρχει το τμήμα."));
    }
}

function getDepartmentsByUni($uniId) {
    $dept = init();
    $stmt = $dept->readByUniId($uniId);
    $deptArray = getResults($stmt);
    echo json_encode($deptArray);
}

function getDepartments() {
    $dept = init();
    $stmt = $dept->read();
    $deptArray = getResults($stmt);
    if (count($deptArray)) {
        http_response_code(200);
        echo json_encode($deptArray);
    } else {
        http_response_code(404);
        echo json_encode(array("error" => "Δεν βρέθηκαν τμήματα."));
    }
}
