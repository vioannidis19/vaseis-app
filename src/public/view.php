<?php
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';

$minYear = apiCall("https://vaseis.iee.ihu.gr/api/index.php/bases/?year=min");
$maxYear = apiCall("https://vaseis.iee.ihu.gr/api/index.php/bases/?year=max");
$id = explode(',', $_GET['id']);
$depts = array();
$unis = array();
$bases = array();
$basesFirst = array();
$places = array();
$years = array();
$codes = array();
$i = 0;
foreach ($id as $code) {
    $codes[$i] = $code;
    $i++;
    $bases[$code] = array();
    $basesFirst[$code] = array();
    $places[$code] = array();
    $unis[$code] = array();
    $depts[$code] = array();
    $url = 'https://vaseis.iee.ihu.gr/api/index.php/bases/department/' . $code . '?type=gel-ime-gen&details=full';
    $base = apiCall($url);
    $base = $base['records'];
    $years[$code] = array();
    foreach ($base as $b) {
        array_push($bases[$code], $b["baseLast"]);
        array_push($basesFirst[$code], $b["baseFirst"]);
        array_push($places[$code], $b["positions"]);
        array_push($unis[$code], $b["uniTitle"]);
        array_push($depts[$code], $b["deptName"]);
        array_push($years[$code], $b["year"]);
    }
}
function fillDataList() {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/departments";
    $depts = apiCall($url);
    foreach ($depts as $dept) {
        echo '<option value="' . $dept["code"] . '-' . $dept["name"]  . '">';
    }
}

function fillSelect($codes) {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/statistics/department/${codes[0]}?year=min";
    $minYear = apiCall($url);
    $maxYear = apiCall("https://vaseis.iee.ihu.gr/api/index.php/statistics/department/${codes[0]}?year=max");
    $minYear = $minYear["minYear"];
    $maxYear = $maxYear["maxYear"];
    for ($i = $minYear; $i <= $maxYear; $i++) {
        if ($i == $maxYear) {
            echo "<option value='${i}' selected>${i}</option>";
        }else {
            echo "<option value='${i}'>${i}</option>";
        }
    }
}

function fillBaseSelect($codes) {
    $minYear = apiCall("https://vaseis.iee.ihu.gr/api/index.php/bases/department/${codes[0]}?year=min");
    $maxYear = apiCall("https://vaseis.iee.ihu.gr/api/index.php/bases/department/${codes[0]}?year=max");
    $minYear = $minYear["minYear"];
    $maxYear = $maxYear["maxYear"];
    for ($i = $minYear; $i <= $maxYear; $i++) {
        if ($i == $maxYear) {
            echo "<option value='${i}' selected>${i}</option>";
        }else {
            echo "<option value='${i}'>${i}</option>";
        }
    }
}

function getTenPercent($codes) {
    $bases = apiCall("https://vaseis.iee.ihu.gr/api/index.php/bases/department/${codes[0]}?type=gel-ime-ten&details=full");
    $bases = $bases['records'];
    return $bases;
}
