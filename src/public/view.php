<?php
if(isset($_GET['dept'])) {
    $depts = "";
    foreach ($_GET['dept'] as $dept) {
        echo $dept;
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
