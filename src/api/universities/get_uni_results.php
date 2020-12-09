<?php

function getResults($stmt): array
{
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if($num>0){
        $universityArray = array();
        $universityArray["records"] = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);
            $universityItem = array(
                "id" => $id,
                "title" => $title,
                "full-title" => $full_title
            );

            array_push($universityArray["records"], $universityItem);
        }
        http200();
        return $universityArray;
    } else {
        return http404();
    }
}
