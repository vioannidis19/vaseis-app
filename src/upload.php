<?php

include 'connection.php';
$conn = dbConnect();
error_reporting(E_ALL);
ini_set('display_errors',1);

if (isset($_POST['submit']))
{
    //upload files and get their name
    $fileName = uploadFile();
    if(!$fileName) {
        echo 'Δεν ανέβηκαν αρχεία';
    } else {
        //get years from file names, example file name: vaseis.2020.csv
        $year = getYear($fileName);

        //opening, reading and uploading base data to db
        if (isset($fileName["vaseis"]))
        {
            if($handle = fopen($fileName['vaseis'], 'r'))
            {
                while ($data = fgetcsv($handle))
                {
                    //fix base number, by removing comma
                    if (strpos($data[6], ',') || strpos($data[7], ','))
                    {
                        $data[6] = str_replace(',', '', $data[6]);
                        $data[7] = str_replace(',', '', $data[7]);
                    }
                    uploadVaseis($conn, $data, $year["vaseis"]);
                }
                echo 'Το αρχείο των βάσεων ανέβηκε.';
            }
        }

        //opening, reading and uploading stats data to db
        if (isset($fileName["stats"]))
        {
            if($handle = fopen($fileName['stats'], 'r'))
            {
                while ($data = fgetcsv($handle))
                {
                    if (strpos($data[1], ',') || strpos($data[2], ',') || strpos($data[3], ',') ||
                        strpos($data[4], ',') || strpos($data[5], ',') || strpos($data[6], ','))
                    {
                        $data[1] = str_replace(',', '', $data[1]);
                        $data[2] = str_replace(',', '', $data[2]);
                        $data[3] = str_replace(',', '', $data[3]);
                        $data[4] = str_replace(',', '', $data[4]);
                        $data[5] = str_replace(',', '', $data[5]);
                        $data[6] = str_replace(',', '', $data[6]);
                    }
                    uploadStats($conn, $data, $year["stats"]);
                }
                echo 'Το αρχείο των στατιστικών ανέβηκε.';
            }
        }

        //delete uploaded files when done
        deleteFiles($fileName);
    }
}

function uploadFile()
{
    $fileName = [];
    if(!file_exists($_FILES["vaseis"]["tmp_name"]) && !file_exists($_FILES["stats"]["tmp_name"])) return false;
    $targetDir = './';
    if(file_exists($_FILES["vaseis"]["tmp_name"]))
    {
        $fileName['vaseis'] = basename($_FILES["vaseis"]["name"]);
        $vaseisFileDir = $targetDir . $fileName['vaseis'];
        move_uploaded_file($_FILES["vaseis"]["tmp_name"], $vaseisFileDir);
    }
    if(file_exists($_FILES["stats"]["tmp_name"]))
    {
        $fileName['stats'] = basename($_FILES["stats"]["name"]);
        $statsFileDir = $targetDir . $fileName['stats'];
        move_uploaded_file($_FILES["stats"]["tmp_name"], $statsFileDir);
    }
    return $fileName;
}

function getYear($fileName)
{
    $year = [];
    if(isset($fileName["vaseis"]))
    {
        $vaseisFileNameSplit = explode(".", $fileName['vaseis']);
        $year["vaseis"] = $vaseisFileNameSplit[1];
    }
    if(isset($fileName["stats"]))
    {
        $statsFileNameSplit = explode(".", $fileName['stats']);
        $year["stats"] = $statsFileNameSplit[1];
    }
    return $year;
}

function deleteFiles($file)
{
    if(isset($file['vaseis'])) unlink($file['vaseis']);
    if(isset($file['stats'])) unlink($file['stats']);
}

function uploadVaseis($conn, $data, $year)
{
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
    $stmt->bind_param('ssssssss', $data[0], $data[8], $data[3], $data[5], $data[4], $year, $data[6], $data[7]);
    $stmt->execute();
}

function uploadStats($conn, $data, $year)
{
    $stmt = $conn->prepare("INSERT INTO examtype (`title`) VALUES (?) ON DUPLICATE KEY UPDATE title=?");
    $stmt->bind_param('ss', $data[8], $data[8]);
    $stmt->execute();

    for ($i = 1; $i <= 7; $i++)
    {
        $plithosValue = $data[$i];
        if ($data[$i] = "") $plithosValue = 'NULL';
        $stmt = $conn->prepare("INSERT INTO statistics (`code`, `id`, `category`, `protimisi`, `plithos`, `year`) VALUES (?,?,?,?,?,?)
                        ON DUPLICATE KEY UPDATE code=?");
        $stmt->bind_param('sssssss', $data[0], $data[8], $data[9], $i, $plithosValue, $year, $data[0]);
        $stmt->execute();
    }
}