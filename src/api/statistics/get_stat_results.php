<?php

function getResults($stmt)
{

    $result = $stmt->get_result();
    $num = $result->num_rows;
    if ($num>0) {
        $statArray = array();
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $statItem = array(
                "code" => $code,
                "examType" => $id,
                "category" => $category,
                "preference" => $protimisi,
                "count" => $plithos,
                "year" => $year
            );

            array_push($statArray, $statItem);
        }
        http200();
        return $statArray;
    } else {
        return http404();
    }
}
