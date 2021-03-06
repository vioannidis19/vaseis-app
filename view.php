<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/public/view.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/favicon.jpg">
    <title>Σύγκριση Βάσεων | vaseis-app</title>
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
            <div class="type-container">
                <span>Διάγραμμα Βάσεων Εισαγωγής από</span>
                <select class="type-select">
                    <option value="ΓΕΛ">Γενικά Λύκεια</option>
                    <option value="ΕΠΑΛ">ΕΠΑΛ</option>
                </select>
            </div>
            <div class="chart">
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="base">
                    <input type="checkbox" name="show-legend" class="show-legend">
                    <label for="show-legend">Απόκρυψη Μεταβλητών</label>
                    <div class="search-field">
                        <div class="year-filter">
                            <div>Έτη</div>
                            <label for="year-from">Από</label>
                            <input type="number" name="year-from" class="year-from" min="2013" value="<?php echo $minYear["minYear"] ?>" disabled>

                            <label for="year-to">Έως</label>
                            <input type="number" name="year-to" class="year-to" min="2014" value="<?php echo $maxYear["maxYear"] ?>">
                        </div>
                        <div class="btn-container">
                            <a href="#details">
                                <div class="scroll-btn">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <section>
        <div class="landing details" id="details">
            <div class="dept-list">
                <div class="search-field">
                    <input list="depts" placeholder="Αναζητήστε" class="list">
                    <datalist id="depts">
                        <?php fillDataList() ?>
                    </datalist>
                    <input type="button" value="Προσθήκη" class="ok-btn">
                </div>
                <?php foreach ($id as $code) {
                    echo '<a href="#details">';
                    echo "<div class='dept-container' id='${code}'>";
                    echo '<span class="remove-dept">X</span>';
                    echo '<div class="dept">Τμήμα ' . $depts[$code][0] . '</div>';
                    echo '<div class="uni">' . $unis[$code][0] . '</div>';
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </div>
            <div class="details-container">
                <div class="dept-details">
                    <h2 class="dept-title">Τμήμα <?php echo $depts[$id[0]][0] ?></h2>
                    <h4 class="uni-title"><?php echo $unis[$id[0]][0] ?></h4>
                </div>
                <div class="base-details" id="<?php echo $id[0]?>">
                    <h3>Βάσεις</h3>
                    <span>Για το έτος </span><select class="base-year-select">
                        <?php
                        fillBaseSelect($codes);
                        ?>
                    </select>
                    <h4>90%</h4>
                    <div>
                        <?php
                        echo "<span><span class='year'>Βαθμός Πρώτου: </span>" . $basesFirst[$id[0]][count($basesFirst[$id[0]]) -1] . "</span>";
                        echo "<span><span class='year'>Βαθμός Τελευταίου: </span>" . $bases[$id[0]][count($bases[$id[0]]) -1] . "</span>";
                        echo "<span><span class='year'>Εισακτέοι: </span>" . $places[$id[0]][count($places[$id[0]]) -1] . "</span>";?>
                    </div>
                    <h4>10%</h4>
                    <div>
                        <?php
                        $bases = getTenPercent($codes);
                        $year = 0;
                        $count = count($bases);
                        for ($i = $count-1; $i > $count-3; $i--) {
                            $baseFirst = $bases[$i]['baseFirst'];
                            $baseLast = $bases[$i]['baseLast'];
                            $positions = $bases[$i]['positions'];
                            $special = explode(' ', $bases[$i]['specialCat']);
                            if ($special[count($special)-1] == "ΣΕΙΡΑ") {
                                $special[count($special)-1] = "2012";
                            }
                            echo "<span>" . $special[count($special) -1] . ": ";
                            echo "<span></span><span class='year'>Βαθμός Πρώτου: </span>" . $baseFirst . "</span>";
                            echo "<span><span class='year'>Βαθμός Τελευταίου: </span>" . $baseLast . "</span>";
                            echo "<span><span class='year'> Εισακτέοι: </span>" . $positions . "</span>";
                            echo "</span><br>";
                        }
                        ?>
                    </div>
                </div>
                <div class="stats-details">
                    <h3>Στατιστικά</h3>
                    <span>Για το έτος </span><select class="year-select">
                        <?php
                        fillSelect($codes);
                        ?>
                    </select>
                    <div class="chart-container">
                        <div>
                            <canvas id="stats-left"></canvas>
                        </div>
                        <div>
                            <canvas id="stats-right"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="/vaseis-app/js/view.js"></script>
</body>
</html>
