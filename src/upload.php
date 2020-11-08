<?php

include 'connection.php';
$conn = dbConnect();

if (isset($_POST['submit']))
{
    //upload files and get their name
    $fileName = uploadFile();

    //get years from file names, example file name: vaseis.2020.csv
    $vaseisFileNameSplit = explode(".", $fileName['vaseis']);
    $vaseisYear = $vaseisFileNameSplit[1];
    $statsFileNameSplit = explode(".", $fileName['stats']);
    $statsYear = $statsFileNameSplit[1];

    //opening, reading and uploading base data to db
    if ($handle = fopen($fileName['vaseis'], 'r'))
    {
        while ($data = fgetcsv($handle))
        {
            //fix base number, by removing comma
            $data[6] = str_replace(',', '', $data[6]);
            $data[7] = str_replace(',', '', $data[7]);

            uploadVaseis($conn, $data, $vaseisYear);
        }
    }

    //opening, reading and uploading stats data to db
    if ($handle = fopen($fileName['stats'], 'r'))
    {
        while ($data = fgetcsv($handle))
        {
            //TODO: Check if comma is included in numbers
            uploadStats($conn, $data, $statsYear);
        }
    }

    //delete uploaded files when done
    deleteFiles($fileName);
}

function uploadFile()
{
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

function deleteFiles($file)
{
    unlink($file['vaseis']);
    unlink($file['stats']);
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
        $stmt = $conn->prepare("INSERT INTO statistics (`code`, `id`, `category`, `protimisi`, `plithos`, `year`)                         VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssssss', $data[0], $data[8], $data[9], $i, $plithosValue, $year);
        $stmt->execute();
    }
}