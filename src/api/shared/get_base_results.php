<?php

function getResults($stmt){
    $result = $stmt->get_result();
    $num = $result->num_rows;
    $currentCode = 0;
    $currentType = '';
    if($num>0){
        $baseArray = array();
        $baseArray["records"] = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);
            if($code != $currentCode) $currentCode = $code;
            if($title != $currentType) $currentType = $title;

            $baseItem = array(
                "code" => $code,
                "examType" => $title,
                "specialCat" => $cat_title,
                "positions" => $positions,
                "baseFirst" => $vasiprotou,
                "baseLast" => $vasitel
            );

            array_push($baseArray["records"], $baseItem);
        }
        http_response_code(200);
        return $baseArray;
    } else {
        http_response_code(404);
        return array("message" => "Δεν βρέθηκαν βάσεις για αυτή τη χρονιά");
    }
}
