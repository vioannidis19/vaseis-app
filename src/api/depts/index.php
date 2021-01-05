<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Department.php';
require 'get_dept_results.php';

function init(): Department
{
    $database = new Database();
    $db = $database->getConnection();
    return new Department($db);
}

function getDeptResults($uri) {
    if (isset($uri[5])) http400();
    if (isset($uri[4])) {
        if($uri[3] == "university") getDepartmentsByUni($uri[4]);
        else http400();
    }
    elseif (isset($uri[3])) {
        if(isset($_GET)) {
            getDepartments();
        } else {
            getDepartment($uri[3]);
        }
    }
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
        http200();
        echo json_encode($deptArray);
    } else {
        echo json_encode(http404());
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
    if (is_numeric($stmt)) {
        return -1;
    }

    $deptArray = getResults($stmt);
    echo json_encode($deptArray);
}
