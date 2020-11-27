<?php

function getResults($stmt) {
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num>0) {
        $deptArray = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);
            $deptItem = array(
                "code" => $code,
                "name" => $name,
                "uni-id" => $uni_id,
            );
            array_push($deptArray, $deptItem);
        }
        http_response_code(200);
        return $deptArray;
    } else {
        http_response_code(404);
        return array("error" => "Δεν βρέθηκαν τμήματα");
    }
}
