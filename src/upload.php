<?php
$environment = 'DEVELOPMENT';

if ($environment == 'DEVELOPMENT') {
    error_reporting(E_ALL);
    ini_set('display_errors',1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}



include_once '../config/database.php';
$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['submit-info'])) {
    $fileName = basename($_FILES["info"]["name"]);
    if (!$fileName) {
        echo "Δεν δόθηκε αρχείο";
    } else {
        if ($handle = fopen($_FILES["info"]["tmp_name"], 'r')) {
            while($data = fgetcsv($handle)) {
                $uni = $data[0];
                $dept = $data[1] . '%';
                $phone = $data[2];
                $email = $data[3];
                $website = $data[4];
                $stmt = $conn->prepare("UPDATE dept LEFT JOIN university u on dept.uni_id = u.id 
                    SET websiteURL = ?, phone = ?, email = ? WHERE name LIKE ? AND u.title = ?");
                $stmt->bind_param('sssss', $website, $phone, $email, $dept, $uni);
                $stmt->execute();
            }
        }
    }
}

if (isset($_POST['submit']))
{
    //upload files and get their name
    $fileName = uploadFile();
    if(!$fileName) {
        echo 'Δεν ανέβηκαν αρχεία';
    } else {
        //get years from file names, example file name: vaseis.2020.csv
        $year = getYear($fileName);

        $driver = new mysqli_driver();
        $driver->report_mode = MYSQLI_REPORT_OFF;
        //opening, reading and uploading bases data to db
        if (isset($fileName["vaseis"]))
        {
            if($handle = fopen($_FILES["vaseis"]["tmp_name"], 'r'))
            {
                $error = false;
                $conn->begin_transaction();
                while ($data = fgetcsv($handle))
                {
                    //fix bases number, by removing comma
                    if (strpos($data[6], ',') || strpos($data[7], ','))
                    {
                        $data[6] = str_replace(',', '', $data[6]);
                        $data[7] = str_replace(',', '', $data[7]);
                    }

                    $error = uploadVaseis($conn, $data, $year["vaseis"]);
                }
                $conn->commit();
                if ($error) {
                    echo 'Υπήρξε σφάλμα, το αρχείο των βάσεων δεν ανέβηκε';
                } else {
                    echo 'Το αρχείο των βάσεων ανέβηκε.';
                }
            }
        }

        //opening, reading and uploading stats data to db
        if (isset($fileName["stats"]))
        {
            if($handle = fopen($_FILES["stats"]["tmp_name"], 'r'))
            {
                $error = false;
                $conn->begin_transaction();
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
                    $error = uploadStats($conn, $data, $year["stats"]);
                    if ($error) break;
                }
                $conn->commit();
                if ($error) {
                    echo 'Υπήρξε σφάλμα, το αρχείο των στατιστικών δεν ανέβηκε';
                } else {
                    echo 'Το αρχείο των στατιστικών ανέβηκε.';
                }
            }
        }

        $conn->close();
    }
}

function uploadFile()
{
    $fileName = [];
    if(!file_exists($_FILES["vaseis"]["tmp_name"]) && !file_exists($_FILES["stats"]["tmp_name"])) return false;
    if(file_exists($_FILES["vaseis"]["tmp_name"]))
        $fileName['vaseis'] = basename($_FILES["vaseis"]["name"]);
    if(file_exists($_FILES["stats"]["tmp_name"]))
        $fileName['stats'] = basename($_FILES["stats"]["name"]);
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

function uploadVaseis($conn, $data, $year)
{
    try {
        $stmt = $conn->prepare("INSERT INTO university (`title`) VALUES (?) ON DUPLICATE KEY UPDATE title=?");
        $stmt->bind_param('ss', $data[1], $data[1]);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO dept (`code`, `name`, `uni_id`) 
                VALUES (?,?,(SELECT id FROM university WHERE title=?))
                ON DUPLICATE KEY UPDATE code=?");
        $stmt->bind_param('ssss', $data[0], $data[2], $data[1], $data[0]);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO `examtype` (`title`)
                VALUES (?) ON DUPLICATE KEY UPDATE `title`=?");
        $stmt->bind_param('ss', $data[8], $data[8]);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO specialcat (`code`, `title`)
                VALUES (?,?) ON DUPLICATE KEY UPDATE title=?");
        $stmt->bind_param('sss', $data[0], $data[3], $data[3]);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO base 
                    (`code`, `title`, `cat_title`, `positions`, `field`, `year`, `vasiprotou`, `vasitel`) 
                    VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssssss', $data[0], $data[8], $data[3], $data[5], $data[4], $year, $data[6], $data[7]);
        $stmt->execute();
        return false;
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        echo $e->getMessage();
        return true;
    }
}

function uploadStats($conn, $data, $year)
{
    $stmt = $conn->prepare("INSERT INTO examtype (`title`) VALUES (?) ON DUPLICATE KEY UPDATE title=?");
    $stmt->bind_param('ss', $data[8], $data[8]);
    $stmt->execute();

    for ($i = 1; $i<=7; $i++)
    {
        echo $i;
        if ($data[$i] == "") $plithosValue = 'NULL';
            else $plithosValue = $data[$i];
        $stmt = $conn->prepare("INSERT INTO statistics (`code`, `id`, `category`, `protimisi`, `plithos`, `year`) 
                    VALUES (?,?,?,?,?,?) ON DUPLICATE KEY UPDATE code=?");
        $stmt->bind_param('sssssss', $data[0], $data[8], $data[9], $i, $plithosValue, $year, $data[0]);
        if (!$stmt) {
            $conn->rollback();
            return false;
        }
        $stmt->execute();
    }

}
