<?php

function getResults($stmt){
    $result = $stmt->get_result();
    $num = $result->num_rows;
    if($num>0){
        $baseArray = array();
        $baseArray["records"] = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);
            $baseItem = array(
                "code" => $code,
                "examType" => $title,
                "specialCat" => $cat_title,
                "positions" => $positions,
                "baseFirst" => $vasiprotou,
                "baseLast" => $vasitel,
                "year" => $year
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
