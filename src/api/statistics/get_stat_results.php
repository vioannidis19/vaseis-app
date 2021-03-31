<?php

function getResults($stmt): array
{

    $result = $stmt->get_result();
    $num = $result->num_rows;
    if ($num>0) {
        $statArray = array();
        while ($row = $result->fetch_assoc()) {
            /**
             * @var $code
             * @var $id
             * @var $category
             * @var $protimisi
             * @var $plithos
             * @var $year
             */
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

function getResultsV1($stmt): array
{
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if ($num > 0) {
        $statArray = array();
        $deptItem = null;
        $lastCode = 0;
        while ($row = $result->fetch_assoc()) {
            /**
             * @var $code
             * @var $year
             * @var $examType
             * @var $count
             * @var $totalSuccessful
             * @var $totalCandidates
             * @var $s_first
             * @var $s_second
             * @var $s_third
             * @var $s_fourth
             * @var $s_fifth
             * @var $s_sixth
             * @var $s_other
             * @var $c_first
             * @var $c_second
             * @var $c_third
             * @var $c_fourth
             * @var $c_fifth
             * @var $c_sixth
             * @var $c_other
             * @var $category
             */
            extract($row);
            if ($lastCode != $code) {
                if ($deptItem != null) array_push($statArray, $deptItem);
                $deptItem = array(
                  "code" => $code,
                  "statistics" => array()
                );
                $lastCode = $code;
            }

            if ($category === 0) {
                $statItem = array(
                    "year" => $year,
                    "examType" => $examType,
                    "positions" => $count,
                    "totalSuccessful" => $totalSuccessful,
                    "totalCandidates" => $totalCandidates,
                    "candidatePreferences" => array(
                        "first" => $c_first,
                        "second" => $c_second,
                        "third" => $c_third,
                        "other" => $c_other
                    )
                );
            } else {
                $statItem['successfulPreferences'] = array(
                    "first" => $s_first,
                    "second" => $s_second,
                    "third" => $s_third,
                    "fourth" => $s_fourth,
                    "fifth" => $s_fifth,
                    "sixth" => $s_sixth,
                    "other" => $s_other
                );
                array_push($deptItem['statistics'], $statItem);
            }
        }
        array_push($statArray, $deptItem);
        http200();
        return $statArray;
    }else {
        return http404();
    }
}
