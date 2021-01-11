<?php
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';

if (isset($_GET['dept']) && isset($_GET['dept-search'])) {
    $depts = "";
    foreach ($_GET['dept'] as $dept) {
        $depts .= $dept . ',';
    }
    $depts = substr($depts, 0, strlen($depts) -1);
    if($_GET['dept-search'] != '') {
        $dept = explode('-', $_GET['dept-search']);
        $depts .= ',' . $dept[0];
    }
    header('Location: view.php?id=' . $depts);
}
elseif(isset($_GET['dept'])) {
    $depts = "";
    foreach ($_GET['dept'] as $dept) {
        $depts .= $dept . ',';
    }
    $depts = substr($depts, 0, strlen($depts) -1);
    header('Location: view.php?id=' . $depts);
}
elseif(isset($_GET['dept-search'])) {
    if($_GET['dept-search'] != ''){
        $dept = explode("-", $_GET['dept-search']);
        header('Location: view.php?id=' . $dept[0]);
    } else {
        header('Location: index.php');
    }
}

function fillDataList() {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/departments";
    $depts = apiCall($url);
    foreach ($depts as $dept) {
        echo '<option value="' . $dept["code"] . '-' . $dept["name"]  . '">';
    }
}

function fillList() {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/universities";
    $unis = apiCall($url);
    foreach ($unis["records"] as $uni) {
        $url = "https://vaseis.iee.ihu.gr/api/index.php/departments/university/" . $uni["id"];
        $depts = apiCall($url);
        echo '<li><input type="checkbox"" class="uni-checkbox">' . '<label for="uni[]">' . $uni["full-title"] . '</label>';
        echo "<ul>";
        foreach ($depts as $dept) {
            echo '<li><input type="checkbox" name="dept[]" class="dept-checkbox" value="' . $dept['code'] . '"><label for="dept[]" class="dept-label">' . $dept["name"] . "</label></li>";
        }
        echo "</li></ul>";
    }
}
