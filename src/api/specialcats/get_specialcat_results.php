<?php

function getResults($stmt) {
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num>0) {
        $specialCatArray = array();
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $specialCatItem = array(
                "code" => $code,
                "title" => $title
            );
            array_push($specialCatArray, $specialCatItem);
        }
        http200();
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';
        return $specialCatArray;
    } else {
        return http404();
    }
}
