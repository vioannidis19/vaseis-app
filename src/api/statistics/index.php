<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/objects/Statistic.php';
require 'get_stat_results.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
function init(): Statistic {
    $database = new Database();
    $db = $database->getConnection();
    return new Statistic($db);
}

function getStatResults($uri) {
    if (isset($uri[8])) http400();
    elseif (isset($uri[7])) {
        if($uri[6] == "category" && $uri[4] == "university") {
            getStatsByYearUniAndCategory($uri[3], $uri[5], $uri[7]);
        } elseif ($uri[6] == "category" && $uri[4] == "department") {
            getStatsByYearDeptAndCategory($uri[3], $uri[5], $uri[7]);
        } else {
            http400();
        }
    } elseif (isset($uri[6])) {
        if($uri[5] == "category" && $uri[3] == "university") {
            getStatsByUniAndCategory($uri[4], $uri[6]);
        } elseif ($uri[5] == "category" && $uri[3] == "department") {
            getStatsByDeptAndCategory($uri[4], $uri[6]);
        } else {
            http400();
        }
    } elseif (isset($uri[5])) {
        if($uri[4] == "university") {
            getStatsByYearAndUniversity($uri[3], $uri[5]);
        } elseif ($uri[4] == "category") {
            getStatsByYearAndCategory($uri[3], $uri[5]);
        } else {
            http400();
        }
    } elseif (isset($uri[4])) {
        if($uri[3] == "university") {
            getStatsByUniversity($uri[4]);
        } elseif ($uri[3] == "department") {
            getStatsByDepartment($uri[4]);
        } else {
            http400();
        }
    } elseif (isset($uri[3])) {
        if(isset($_GET["year"])) {
            if ($_GET["year"] == "min") {
                getMinYear();
            } elseif ($_GET["year"] == "max") {
                getMaxYear();
            } else {
                http400();
            }
        } else {
            getStatsByYear($uri[3]);
        }
    } else {
        http400();
    }
}

function getStatsByYearUniAndCategory($year, $uniId, $category) {
    $stat = init();
    $url = "127.0.0.1/vaseis-app/api/departments/university/" . $uniId;
    $depts = apiCall($url);
    $statArray = array();
    foreach ($depts as $dept) {
        $stmt = $stat->readByYearUniAndCategory($year, $dept["code"], $category);
        array_push($statArray, getResults($stmt, $stat));
        $stmt->free_result();
    }
    echo json_encode($statArray);
}

function getStatsByYearDeptAndCategory($year, $deptId, $category) {
    $stat = init();
    $stmt = $stat->readByYearDeptAndCategory($year, $deptId, $category);
    if (is_numeric($stmt)) {
        return -1;
    }
    $statArray = getResults($stmt);
    echo json_encode($statArray);
}

function getStatsByDeptAndCategory($dept, $category) {
    $stat = init();
    $stmt = $stat->readByDeptAndCategory($dept, $category);
    if (is_numeric($stmt)) {
        return -1;
    }
    $statArray = getResults($stmt);
    echo json_encode($statArray);
}

function getStatsByUniAndCategory($uniId, $category) {
    $stat = init();
    $url = "127.0.0.1/vaseis-app/api/departments/university/" . $uniId;
    $depts = apiCall($url);
    $statArray = array();
    foreach ($depts as $dept) {
        $stmt = $stat->readByDeptAndCategory($dept["code"], $category);
        array_push($statArray, getResults($stmt));
        $stmt->free_result();
    }
    echo json_encode($statArray);
}

function getStatsByYearAndUniversity($year, $uniId) {
    $stat = init();
    $url = "127.0.0.1/vaseis-app/api/departments/university/" . $uniId;
    $depts = apiCall($url);
    $statArray = array();
    foreach ($depts as $dept) {
        $stmt = $stat->readByYearAndDept($year, $dept["code"]);
        array_push($statArray, getResults($stmt));
        $stmt->free_result();
    }
    echo json_encode($statArray);
}

function getStatsByYearAndCategory($year, $category) {
    $stat = init();
    $stmt = $stat->readByYearAndCategory($year, $category);
    $statArray = getResults($stmt);
    echo json_encode($statArray);
}

function getStatsByUniversity($uniId) {
    $stat = init();
    $url = "127.0.0.1/vaseis-app/api/departments/university/" . $uniId;
    $depts = apiCall($url);
    $statArray = array();
    foreach ($depts as $dept) {
        $stmt = $stat->readByDepartment($dept["code"]);
        array_push($statArray, getResults($stmt));
        $stmt->free_result();
    }
    echo json_encode($statArray);
}

function getStatsByDepartment($deptId) {
    $stat = init();
    $stmt = $stat->readByDepartment($deptId);
    $statArray = getResults($stmt);
    echo json_encode($statArray);
}

function getStatsByYear($year) {
    $stat = init();
    if (strpos($year, '?')) $year = explode('?', $year);
    if (is_array($year)) {
        $stmt = $stat->readByYear($year[0]);
        $tempArray = getResults($stmt);
        $stmt->free_result();
        $statArray = $stat->paginate($year[0]);
    }
    else {
        $stmt = $stat->readByYear($year);
        $tempArray = getResults($stmt);
        $stmt->free_result();
        $statArray = $stat->paginate($year);
    }
    array_push($statArray, $tempArray);
    echo json_encode($statArray);
}

function getMinYear() {
    $stat = init();
    $stmt = $stat->readMinYear();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    extract($row);
    $baseItem = array(
        "minYear" => $minYear
    );
    echo json_encode($baseItem);
}

function getMaxYear() {
    $stat = init();
    $stmt = $stat->readMaxYear();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    extract($row);
    $baseItem = array(
        "maxYear" => $maxYear
    );
    echo json_encode($baseItem);
}




