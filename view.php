<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';
    $id = explode(',', $_GET['id']);
    $depts = array();
    $unis = array();
    $bases = array();
    foreach ($id as $code) {
        $bases[$code] = array();
        $unis[$code] = array();
        $depts[$code] = array();
        $url = 'localhost/vaseis-app/api/bases/department/' . $code . '?type=gel-ime-gen&details=full';
        $base = apiCall($url);
        $base = $base['records'];
        foreach ($base as $b) {
            array_push($bases[$code], $b["baseLast"]);
            array_push($unis[$code], $b["uniTitle"]);
            array_push($depts[$code], $b["deptName"]);
        }
    }
    function fillDataList() {
        $url = "localhost/vaseis-app/api/departments";
        $depts = apiCall($url);
        foreach ($depts as $dept) {
            echo '<option value="' . $dept["code"] . '-' . $dept["name"]  . '">';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/cd008643b6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/vaseis-app/css/view.css">
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="logo">vaseis-app</div>
            <div class="back"><a href="index.php">Επιστροφή στην Αρχική</a></div>
        </div>
    </nav>
    <section>
        <div class="landing">
            <div class="chart">
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="base">
                    <div class="search-field">
                        <input list="depts" placeholder="Αναζητήστε" class="list">
                        <datalist id="depts">
                            <?php fillDataList() ?>
                        </datalist>
                        <input type="button" value="Προσθήκη" class="ok-btn">
                    </div>
                    <?php foreach ($id as $code) {
                        echo '<div class="dept-container">';
                        echo '<div class="dept">Τμήμα ' . $depts[$code][0] . '</div>';
                        echo '<div class="uni">' . $unis[$code][0] . '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="/vaseis-app/js/view.js"></script>
</body>
</html>
