<?php

function getResults($stmt): array
{
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num>0) {
        $deptArray = array();
        if ($_GET["details"] == "full") {
            while ($row = $result->fetch_assoc()) {
                extract($row);
                $deptItem = array(
                    "code" => $code,
                    "name" => $name,
                    "uni-id" => $uni_id,
                    "title" => $title,
                    "fullTitle" => $full_title,
                    "isActive" => $isActive,
                    "websiteURL" => $websiteURL,
                    "logoURL" => $logoURL,
                    "phone" => $phone,
                    "email" => $email,
                    "uniLogoURL" => $uni_logo
                );
                array_push($deptArray, $deptItem);
            }
        } else {
            while ($row = $result->fetch_assoc()) {
                extract($row);
                $deptItem = array(
                    "code" => $code,
                    "name" => $name,
                    "uni-id" => $uni_id,
                    "isActive" => $isActive,
                    "websiteURL" => $websiteURL,
                    "logoURL" => $logoURL,
                    "phone" => $phone,
                    "email" => $email,
                    "uniLogoURL" => $uni_logo
                );
                array_push($deptArray, $deptItem);
            }
        }
        http200();
        return $deptArray;
    } else {
        return http404();
    }
}
