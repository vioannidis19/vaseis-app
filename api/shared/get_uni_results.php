<?php

function getResults($stmt){
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if($num>0){
        $universityArray = array();
        $universityArray["records"] = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);
            $universityItem = array(
                "id" => $id,
                "title" => $title
            );

            array_push($universityArray["records"], $universityItem);
        }

        http_response_code(200);
        return $universityArray;
    } else {
        http_response_code(404);
        return array("message" => "Δεν βρέθηκαν πανεπιστημία.");
    }
}
