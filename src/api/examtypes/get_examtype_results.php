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
        http_response_code(200);
        return $examTypeArray;
    } else {
        http_response_code(404);
        return array("error" => "Δεν βρέθηκαν τύποι εξέτασης.");
    }
}
