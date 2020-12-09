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
        return $specialCatArray;
    } else {
        return http404();
    }
}
