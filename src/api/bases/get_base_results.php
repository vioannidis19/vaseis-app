<?php

function getResultsV1($stmt) : array {
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num > 0) {
        $baseArray = array();
        $deptItem = null;
        $lastCode = 0;
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            extract($row);
            if ($lastCode != $code) {
                if ($deptItem != null) array_push($baseArray, $deptItem);
                $deptItem = array(
                    "code" => $code,
                    "deptName" => $name,
                    "deptLogoURL" => $dept_logo,
                    "websiteURL" => $websiteURL,
                    "phone" => $phone,
                    "email" => $email,
                    "uniTitle" => $full_title,
                    "uniTitleShort" => $uni_title,
                    "uniLogoURL" => $logoURL,
                    "bases" => array()
                );
                $lastCode = $code;
                $counter = 0;
            }
            $baseItem = array(
                "examType" => $title,
                "specialCat" => $cat_title,
                "positions" => $positions,
                "baseFirst" => $vasiprotou,
                "baseLast" => $vasitel,
                "year" => $year
            );
            array_push($deptItem['bases'], $baseItem);
        }
        array_push($baseArray, $deptItem);
        http200();
        return $baseArray;
    } else {
        return http404();
    }
}

function getResults($stmt): array
{
    $result = $stmt->get_result();
    $num = $result->num_rows;
    if($num>0){
        $baseArray = array();
        $baseArray["records"] = array();
        if (isset($_GET["details"])) {
            while ($row = $result->fetch_assoc()) {
                extract($row);
                $baseItem = array(
                    "code" => $code,
                    "examType" => $title,
                    "specialCat" => $cat_title,
                    "positions" => $positions,
                    "baseFirst" => $vasiprotou,
                    "baseLast" => $vasitel,
                    "year" => $year,
                    "deptName" => $name,
                    "uniTitle" => $full_title
                );
                array_push($baseArray["records"], $baseItem);
            }
        } else {
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
        }

        http200();
        return $baseArray;
    } else {
        return http404();
    }
}

