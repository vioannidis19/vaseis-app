<?php

include 'connection.php';
$conn = dbConnect();

if (isset($_POST['submit'])) {
    //get file names
    $fileName = uploadFile();
    //get years from file names
    $vaseisFileNameSplit = explode(".", $fileName['vaseis']);
    $vaseisYear = $vaseisFileNameSplit[1];
    $statsFileNameSplit = explode(".", $fileName['stats']);
    $statsYear = $statsFileNameSplit[1];

    $vaseis = array();
    if ($handle = fopen($fileName['vaseis'], 'r')) {
        while ($data = fgetcsv($handle)) {
            // TODO: use on duplicate key update instead

            $data[6] = str_replace(',', '', $data[6]);
            $data[7] = str_replace(',', '', $data[7]);
            echo $data[6] . ' ' . $data[7];
            array_push($vaseis, $data);
            $stmt = $conn->prepare("INSERT INTO university (`title`) VALUES (?) ON DUPLICATE KEY UPDATE title=?");
            $stmt->bind_param('ss', $data[1], $data[1]);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO dept (`code`, `name`, `uni_id`) 
                VALUES (?,?,(SELECT id FROM university WHERE title=?))
                ON DUPLICATE KEY UPDATE code=?");
            $stmt->bind_param('ssss', $data[0], $data[2], $data[1], $data[0]);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO examtype (`title`)
                VALUES (?) ON DUPLICATE KEY UPDATE title=?");
            $stmt->bind_param('ss', $data[8], $data[8]);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO specialcat (`code`, `title`)
                VALUES (?,?) ON DUPLICATE KEY UPDATE title=?");
            $stmt->bind_param('sss', $data[0], $data[3], $data[3]);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO base (`code`, `title`, `cat_title`, `positions`, `field`, `year`, `vasiprotou`, `vasitel`)
                    VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssss', $data[0], $data[8], $data[3], $data[5], $data[4], $vaseisYear, $data[6], $data[7]);
            $stmt->execute();
        }
    }
//    $vaseis = saveFiles($fileName);
//    $universities = getUniversities($conn);
//
//    $flag = false;
//    print_r($vaseis[20]);
//    foreach ($universities as $university) {
//        foreach ($vaseis as $vasi) {
//            if ($university['title'] == $vasi[1]) {
//                echo $vasi[1];
//                $flag = true;
//            }
//        }
//    }
//
//    if (!$flag)
//        {
//            $stmt = $conn->prepare("INSERT INTO university (title) VALUES (?)");
//            $stmt->bind_param('s', $data[1]);
//            $stmt->execute();
//        }
//
//    $depts = getDepartments($conn);

    //delete uploaded files when done
    unlink($fileName['vaseis']);
    unlink($fileName['stats']);
}

function uploadFile() {
    $fileName['vaseis'] = basename($_FILES["vaseis"]["name"]);
    $fileName['stats'] = basename($_FILES["stats"]["name"]);
    //setup directory where files will be saved and upload them
    $targetDir = './';
    $vaseisFileDir = $targetDir . $fileName['vaseis'];
    $statsFileDir = $targetDir . $fileName['stats'];

    move_uploaded_file($_FILES["vaseis"]["tmp_name"], $vaseisFileDir);
    move_uploaded_file($_FILES["stats"]["tmp_name"], $statsFileDir);

    return $fileName;
}

function saveFiles($fileName) {
    $vaseis = array();
    if ($handle = fopen($fileName['vaseis'], 'r')) {
        while ($data = fgetcsv($handle)) {
            // TODO: use on duplicate key update instead
            array_push($vaseis, $data);
        }
    }
    return $vaseis;
}

function getUniversities($conn) {
    $selectStmt = $conn->prepare("SELECT title FROM university");
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $universities = array();

    while($row = $result->fetch_assoc())
    {
        array_push($universities, $row);
    }

    return $universities;
}

function getDepartments($conn) {
    $selectStmt = $conn->prepare("SELECT code FROM dept");
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $depts = array();

    while($row = $result->fetch_assoc())
    {
        array_push($depts, $row);
    }

    return $depts;
}