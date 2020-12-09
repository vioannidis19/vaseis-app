<?php

function getResults($stmt) {
    $result = $stmt->get_result();
    $num = $result->num_rows;
    if ($num>0) {
        $examTypeArray = array();
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $examTypeItem = array(
                "title" => $title,
                "description" => $description
            );
            array_push($examTypeArray, $examTypeItem);
        }
        http200();
        return $examTypeArray;
    } else {
        return http404();
    }
}
