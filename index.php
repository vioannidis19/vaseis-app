<?php

require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/api/shared/api_answers.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/public/view.php';
function fillList() {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/universities";
    $unis = apiCall($url);
    foreach ($unis["records"] as $uni) {
        $url = "https://vaseis.iee.ihu.gr/api/index.php/departments/university/" . $uni["id"];
        $depts = apiCall($url);
        echo '<li><input type="checkbox"" class="uni-checkbox">' . '<label for="uni[]">' . $uni["full-title"] . '</label>';
        echo "<ul>";
        foreach ($depts as $dept) {
            echo '<li><input type="checkbox" name="dept[]" value="' . $dept['code'] . '"><label for="dept[]">' . $dept["name"] . "</label></li>";
        }
        echo "</li></ul>";
    }
}

function fillDataList() {
    $url = "https://vaseis.iee.ihu.gr/api/index.php/departments";
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
    <link rel="shortcut icon" href="/img/favicon.jpg">
    <title>Αρχική Σελίδα | vaseis-app</title>
    <script src="https://kit.fontawesome.com/cd008643b6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/vaseis-app/css/main.css">
</head>
<body>
    <div class="container" id="home">
        <div class="hidden bg"></div>
        <div class="landing">
            <div class="nav-bar">
                <ul>
                    <li><a href="#info">Πληροφορίες</a></li>
                    <li><a href="#api">API</a></li>
                </ul>
            </div>
            <div class="landing-text">
                <h2 class="title">vaseis-app</h2>
                <h4 class="subtitle">Δείτε και συγκρίνετε εύκολα τις βάσεις των Πανελλαδικών Εξετάσεων!</h4>
            </div>
            <div class="form-container">
                <form method="get">
                    <div class="tree-view-container">
                        <div class="close-btn">X</div>
                        <div class="tree-view">
                            <?php fillList() ?>
                        </div>
                    </div>
                    <input type="button" value="Επιλέξτε Ιδρύματα" class="selector">
                    <span>ή</span>
                    <input list="depts" name="dept-search" id="" placeholder="Αναζητήστε Ίδρυμα ή Τμήμα">
                    <datalist id="depts">
                        <?php fillDataList() ?>
                    </datalist>
                    <div class="submit-btn-container">
                        <input type="submit" value="Αναζήτηση" class="submit-btn">
                    </div>
                </form>


            </div>

        </div>
        <div class="section-info" id="info">
            <div class="subtitle">
                <h4>Πληροφορίες</h4>
            </div>
            <div class="column-container">
                <div class="section-column">
                    <h5>Η σύγκριση βάσεων έγινε εύκολη!</h5>
                    <i class="fas fa-chart-area"></i>
                    <p>Βρείτε εύκολα το ιστορικό των βάσεων όλων των τμημάτων,
                    συγκρίνετε με άλλα τμήματα και δείτε διαγράμματα που δείχνουν
                    την πορεία αυτών.</p>
                </div>
                <div class="section-column">
                    <h5>Στατιστικά τμημάτων</h5>
                    <i class="fas fa-list-ol"></i>
                    <p>Δείτε τα στατιστικά των προτιμήσεων για κάθε τμήμα.</p>
                </div>
            </div>
            <div class="cta-top">
                <a href="#home"><input type="button" value="Ψάξτε τώρα"></a>
            </div>
        </div>
        <div class="section-api" id="api">
            <h4>API</h4>
            <div class="section-container">
                <div class="section-column-left">
                    <i class="fas fa-code"></i>
                </div>
                <div class="section-column-right">
                    <p>Το vaseis-app προσφέρει ένα ελεύθερο API, με το οποίο μπορείτε
                        να ανακτήσετε οποιαδήποτε πληροφορία θέλετε για τη δικιά σας εφαρμογή.</p>
                    <a href="api"><input type="button" value="Δείτε το API"></a>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer">
                <span class="footer-text">
                    Προγραμματισμός και Υλοποίηση: Βασίλης Ιωαννίδης (<a href="mailto:info@vioannidis.com">info@vioannidis.com</a>)
                    Καθοδήγηση: Στέφανος Ουγιάρογλου (<a href="mailto:stoug@ihu.gr">stoug@ihu.gr</a>, <a href="https://www.iee.ihu.gr/~stoug">https://www.iee.ihu.gr/~stoug</a>)
                </span>
                <span class="footer-text">
                    Εργαστήριο Διαχείρισης Πληροφορίας και Μηχανικής λογισμικού (<a
                            href="https://imselab.iee.ihu.gr/">https://imselab.iee.ihu.gr/</a>), ΤΜΠΗΣ (<a
                            href="https://www.iee.ihu.gr">https://www.iee.ihu.gr</a>), ΔΙΠΑΕ (<a
                            href="https://www.ihu.gr">https://www.ihu.gr</a>)
                </span>
            </div>
        </footer>
    </div>
    <script src="/vaseis-app/js/home.js"></script>
</body>
</html>
