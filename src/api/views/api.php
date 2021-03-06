<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/favicon.jpg">
    <title>API | vaseis-app</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/vaseis-app/css/vendor/prism.css">
    <link rel="stylesheet" href="/vaseis-app/css/api.css">
</head>
<body>
    <div class="container">
        <div class="side-bar">
            <div class="logo">
                <img src="/vaseis-app/img/logo.png" alt="vaseis-app logo">
            </div>
            <span class="close-icon">X</span>
            <div class="list-container">
                <ul class="sections-list">
                    <li class="section-item">
                        <a href="#introduction">Εισαγωγή</a>
                    </li>
                    <li class="section-item"><a href="#changelog">Changelog</a></li>
                    <li class="section-item">
                        <a href="#authorization">Ταυτοποίηση</a>
                    </li>
                    <li class="section-item">
                        <a href="#errors">Σφάλματα</a>
                    </li>
                    <li class="section-item list-title">Endpoints</li>
                    <li class="section-item"><a href="#v1.0">Έκδοση 1.0</a></li>
                    <li class="section-item"><a href="#v1.0-bases-dept">Βάσεις εισαγωγής ανά τμήμα</a></li>
                    <li class="section-item"><a href="#v1.0-bases-depts">Βάσεις εισαγωγής πολλών τμημάτων</a></li>
                    <li class="section-item"><a href="#v1.0-bases-depts-year">Βάσεις εισαγωγής πολλών τμημάτων ανά έτος</a></li>
                    <li class="section-item"><a href="#v1.0-stats-dept">Στατιστικά προτιμήσεων ανά τμήμα</a></li>
                    <li class="section-item"><a href="#api">Κλασσικά endpoints</a></li>
                    <li class="section-item">
                        <a href="#universities">Πανεπιστήμια</a>
                    </li>
                    <li class="section-item">
                        <a href="#all-universities">Σύνολο Πανεπιστημίων</a>
                    </li>
                    <li class="section-item"><a href="#search-universities">Αναζήτηση Πανεπιστημίων</a></li>
                    <li class="section-item"><a href="#bases">Βάσεις</a></li>
                    <li class="section-item"><a href="#bases-year">Αναζήτηση Βάσεων ανά έτος</a></li>
                    <li class="section-item"><a href="#bases-dept">Αναζήτηση Βάσεων ανά τμήμα</a></li>
                    <li class="section-item"><a href="#bases-dept-year">Αναζήτηση Βάσεων ανά έτος και τμήμα</a></li>
                    <li class="section-item"><a href="#search-parameters">Αναζήτηση βάσεων με παραμέτρους</a></li>
                    <li class="section-item"><a href="#search-parameters-base-dept-year">Αναζήτηση με παραμέτρους: βάση, τμήμα, έτος</a></li>
                    <li class="section-item"><a href="#search-parameters-base-dept">Αναζήτηση με παραμέτρους: βάση, τμήμα</a></li>
                    <li class="section-item"><a href="#search-parameters-base-year">Αναζήτηση με παραμέτρους: βάσης, έτος</a></li>
                    <li class="section-item"><a href="#base-data">Έλαχιστο και Μέγιστο Έτος Δεδομένων Βάσεων</a></li>
                    <li class="section-item"><a href="#depts">Τμήματα</a></li>
                    <li class="section-item"><a href="#all-depts">Σύνολο Τμημάτων</a></li>
                    <li class="section-item"><a href="#search-depts">Αναζήτηση Τμήματος</a></li>
                    <li class="section-item"><a href="#uni-depts">Αναζήτηση Τμημάτων ανά πανεπιστήμιο</a></li>
                    <li class="section-item"><a href="#exam-types">Τύποι Εξετάσεων</a></li>
                    <li class="section-item"><a href="#special-categories">Ειδικές Κατηγορίες</a></li>
                    <li class="section-item"><a href="#statistics">Στατιστικά</a></li>
                    <li class="section-item"><a href="#statistics-year">Αναζήτηση Στατιστικών ανά έτος</a></li>
                    <li class="section-item"><a href="#statistics-dept">Αναζήτηση Στατιστικών ανά τμήμα</a></li>
                    <li class="section-item"><a href="#statistics-university">Αναζήτηση Στατιστικών ανά πανεπίστημιο</a></li>
                    <li class="section-item"><a href="#statistics-year-category">Αναζήτηση Στατιστικών ανά έτος και κατηγορία</a></li>
                    <li class="section-item"><a href="#statistics-year-university">Αναζήτηση Στατιστικών ανά έτος και πανεπιστήμιο</a></li>
                    <li class="section-item"><a href="#statistics-university-category">Αναζήτηση Στατιστικών ανά πανεπιστήμιο και κατηγορία</a></li>
                    <li class="section-item"><a href="#statistics-department-category">Αναζήτηση Στατιστικών ανά τμήμα και κατηγορία</a></li>
                    <li class="section-item"><a href="#statistics-year-department-category">Αναζήτηση Στατιστικών ανά έτος, τμήμα και κατηγορία</a></li>
                    <li class="section-item"><a href="#statistics-year-university-category">Αναζήτηση Στατιστικών ανά έτος, πανεπιστήμιο και κατηγορία</a></li>
                    <li class="section-item"><a href="#stats-data">Ελάχιστο και Μέγιστο Έτος Δεδομέων Στατιστικών</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="mobile">
                <img src="/vaseis-app/img/logo.png" alt="vaseis-app logo" class="mobile-logo">
                <span class="hamburger-icon">☰</span>
            </div>
            <h2 class="page-title" id="introduction">API του vaseis-app</h2>
            <div class="section-container">
                <div class="section-item">
                    <p>Το API του vaseis-app χρησιμοποιεί απλά URIs
                    για την ανάκτηση πληροφοριών. Επιστρέφει δεδομένα
                    σε μορφή <a href="https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Objects/JSON" class="">JSON</a>.
                    Παρακάτω αναλύονται οι τρόποι ανάκτησης αυτών των δεδομένων, καθώς
                    και χρήσιμες πληροφορίες.</p>
<!--                    <p>Το API βρίσκεται υπό ενεργή ανάπτυξη και ενδέχεται να γίνουν ριζικές-->
<!--                    αλλαγές στη δομή του. Δεν θα πρέπει να χρησιμοποιηθεί σε εφαρμογές παραγωγής.</p>-->
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Αρχικό URL
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="changelog">Changelog</h3>
                    <p class="changelog-title">14/06/2021</p>
                    <ul>
                        <li>Προσθήκη των νέων endpoints της έκδοσης 1.0 του API.</li>
                        <li>Προσθήκη των πεδίων για τις ιστοσελίδες, λόγοτυπα, αριθμούς τηλεφώνου και email των
                        τμημάτων και πανεπιστημίων</li>
                    </ul>
                    <p class="changelog-title">Μελλοντικά updates</p>
                    <ul>
                        <li>Διόρθωση γνωστών σφαλμάτων</li>
                        <li>Προσθήκη δυνατότητας σελιδοποίησης του API, για την αποφυγή
                        μεταφοράς μεγάλου όγκου δεδομένων.</li>
                    </ul>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="authorization">Επικοινωνία</h3>
                    <p>Για απορίες, προτάσεις και ενημέρωση για προβλήματα επικοινωνήστε στο [info(at)vioannidis(dot)com] (Βασίλης Ιωαννίδης).</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="authorization">Ταυτοποίηση</h3>
                    <p>Η απαίτηση ταυτοποίησης θα προστεθεί μεταγενέστερα.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="authorization">Χρήση του API</h3>
                    <p>Η χρήση του API είναι ελεύθερη και δωρεάν. Συστήνεται η αναφορά χρήσης του vaseis-app API
                    στις εφαρμογές που αναπτύσσονται.</p>
                    <p>Το API προσφέρεται με άδεια χρήσης GPLv3, ο πηγαίος κώδικας είναι διαθέσιμος
                    <a href="https://github.com/vioannidis19/vaseis-app">εδώ</a>. Περισσότερες πληροφορίες για την
                    άδεια χρήσης GPLv3 είναι διαθέσιμες <a href="https://github.com/vioannidis19/vaseis-app/blob/main/LICENSE">εδώ.</a></p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
<!--                    <h3 class="subtitle" id="errors">Σφάλματα</h3>-->
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h2 class="title">Endpoints</h2>
                    <h2 class="subtitle" id="v1.0">Έκδοση 1.0</h2>
                    <p>Η έκδοση 1.0 του API, προσφέρει ανανεωμένα endpoints για τις βάσεις εισαγωγής και τα στατιστικά προτιμήσεων. Τα νεα endpoints προσφέρουν περισσότερο οργανωμένη δομή που έχει
                        ως αποτέλεσμα τη μεταφορά μικρότερου όγκου δεδομένων</p>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="v1.0-bases-dept">Βάσεις εισαγωγής ανά τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> v1.0/bases/department/{dept_id} </p>
                    <p>Επιστρέφει τις βάσεις εισαγωγής για όλα τα διαθέσιμα έτη για το επιλεγμένο τμήμα</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/v1.0/bases/department/1625?type=gel-ime-gen</code></pre>
                        <div class="code-title">
                            Παράδειγμα απάντησης
                        </div>
                        <pre><code class="language-json">[
  {
    "code": 1625,
    "deptName": "ΜΗΧΑΝΙΚΩΝ ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΗΛΕΚΤΡΟΝΙΚΩΝ ΣΥΣΤΗΜΑΤΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
    "deptLogoURL": null,
    "websiteURL": "www.iee.ihu.gr",
    "phone": "2310 013621",
    "email": "info@iee.ihu.gr",
    "uniTitle": "Διεθνές Πανεπιστήμιο της Ελλάδος",
    "uniTitleShort": "ΔΙ.ΠΑ.Ε.",
    "uniLogoURL": "https:\/\/vaseis.iee.ihu.gr\/logos\/university\/dipae.png",
    "bases": [
      {
        "examType": "ΓΕΛ ΗΜΕΡΗΣΙΑ",
        "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
        "positions": 160,
        "baseFirst": 16435,
        "baseLast": 12806,
        "year": 2019,
        "field": ""
      },
      {
        "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ",
        "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
        "positions": 145,
        "baseFirst": 16125,
        "baseLast": 13325,
        "year": 2020,
        "field": "2\/4"
      }
    ]
  }
]
                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="v1.0-bases-depts">Βάσεις εισαγωγής πολλών τμημάτων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> v1.0/bases/?departments={dept_id1,dept_id2,...} </p>
                    <p>Επιστρέφει τις βάσεις εισαγωγής για όλα τα διαθέσιμα έτη για τα τμήματα που δίνονται διαχωριζόμενα από κόμμα</p>
                </div>
                <div class="section-item">

                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="v1.0-bases-depts-year">Βάσεις εισαγωγής πολλών τμημάτων ανά έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> v1.0/bases/{year}/departments=?{dept_id1,dept_id2,...} </p>
                    <p>Επιστρέφει τις βάσεις εισαγωγής για το επιλεγμένο έτος και για τα τμήματα που δίνονται διαχωριζόμενα από κόμμα</p>
                </div>
                <div class="section-item">

                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="v1.0-stats-dept">Στατιστικά προτιμήσεων ανά τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> v1.0/statistics/department/{dept_id} </p>
                    <p>Επιστρέφει τα στατιστικά προτιμήσεων για όλα τα διαθέσιμα έτη για το επιλεγμένο τμήμα</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/v1.0/statistics/department/1625?type=gel-gen</code></pre>
                        <div class="code-title">
                            Παράδειγμα απάντησης
                        </div>
                        <pre><code class="language-json">[
  {
    "code": 1625,
    "statistics": [
      {
        "year": 2019,
        "examType": "ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ",
        "totalSuccessful": null,
        "totalCandidates": null,
        "candidatePreferences": {
          "first": "159",
          "second": "212",
          "third": "238",
          "other": "9549"
        },
        "successfulPreferences": {
          "first": "15",
          "second": "20",
          "third": "24",
          "fourth": "65",
          "fifth": "3",
          "sixth": "8",
          "other": "28"
        }
      },
      {
        "year": 2020,
        "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ",
        "totalSuccessful": null,
        "totalCandidates": null,
        "candidatePreferences": {
          "first": "150",
          "second": "165",
          "third": "193",
          "other": "5798"
        },
        "successfulPreferences": {
          "first": "18",
          "second": "16",
          "third": "20",
          "fourth": "54",
          "fifth": "11",
          "sixth": "9",
          "other": "19"
        }
      }
    ]
  }
]
                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h2 class="subtitle" id="api">Κλασσικά endpoints</h2>
                    <h3 class="subtitle" id="universities">Πανεπιστήμια</h3>
                    <p>Το API προσφέρει τη δυνατότητα ανάκτησης Πανεπιστημίων,
                    ΤΕΙ και λοιπών ανώτατων ιδρυμάτων. Είτε ως σύνολο είτε, μέσω
                    αναζήτησης με συγκεκριμένα κριτήρια.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="all-universities">Σύνολο Πανεπιστημίων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /universities </p>
                    <p>Επιστρέφει το σύνολο των πανεπιστημίων</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Μέρος Τυπικής Απάντησης
                        </div>
                        <pre><code class="language-json">{
  "records": [
	{
      "id": 96087,
      "title": "ΔΙ.ΠΑ.Ε.",
      "full-title": "Διεθνές Πανεπιστήμιο της Ελλάδος"
    },
    {
      "id": 96118,
      "title": "ΔΠΘ",
      "full-title": "Δημοκρίτειο Πανεπιστήμιο Θράκης"
    }
]
}
                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="search-universities">Αναζήτηση Πανεπιστημίων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /universities/{uni_id} </p>
                    <p>Επιστρέφει το Πανεπιστήμιο που αντιστοιχεί στο id που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/universities/96025</code></pre>
                        <div class="code-title">
                            Παράδειγμα Απάντησης
                        </div>
                        <pre><code class="language-json">{
  "id": "96025",
  "title": "ΑΠΘ",
  "full-title": "Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης"
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="bases">Βάσεις</h3>
                    <p>Οι βάσεις των πανελλαδικών μπορούν να ανακτηθούν ως σύνολο
                        ανά έτος ή το ιστορικό ενός τμήματος. Ακόμα μπορεί να ζητηθούν
                        οι βάσεις των τμημάτων ενός Πανεπιστήμιου για κάποιο έτος.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle bases-filters">Φίλτρα</h3>
                    <p>Με τη χρήση φίλτρων δίνεται η δυνατότητα ανάκτησης βάσεων με βάση συγκεκριμένα
                    κριτήρια.</p>
                    <ul>
                        <li>type=gel-ime-gen
                        <p>Επιστρέφει τις βάσεις που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 90% ημερήσιων
                        ΓΕΛ</p></li>
                        <li>type=epal-ime-gen
                        <p>Επιστρέφει τις βάσεις που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 90% ημερήσιων
                        ΕΠΑΛ.</p></li>
                        <li>type=gel-ime-ten
                        <p>Επιστρέφει τις βάσεις που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 10% ημερήσιων
                        ΓΕΛ</p></li>
                        <li>type=epal-ime-ten
                        <p>Επιστρέφει τις βάσεις που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 10% ημερήσιων
                            ΕΠΑΛ</p></li>
                        <li>details=full
                        <p>Με αυτό το φίλτρο για κάθε βάση επιστρέφεται και το όνομα του πανεπιστημίου στο οποίο ανήκει
                        το κάθε τμήμα.</p></li>
                    </ul>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">vaseis.iee.ihu.gr/api/bases/department/1625?type=gel-ime-gen</code></pre>
                        <div class="code-title">Παράδειγμα Απάντησης</div>
                        <pre><code class="language-json">{
  "records": [
    {
      "code": 1625,
      "examType": "ΓΕΛ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
      "positions": 160,
      "baseFirst": 16435,
      "baseLast": 12806,
      "year": 2019
    },
    {
      "code": 1625,
      "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 145,
      "baseFirst": 16125,
      "baseLast": 13325,
      "year": 2020
    }
  ]
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="bases-year">Αναζήτηση Βάσεων ανά έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /bases/{year} </p>
                    <p>Επιστρέφει το σύνολο των βάσεων για το έτος που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/2019</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{"records": [
{
      "code": 1625,
      "examType": "ΓΕΛ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
      "positions": 160,
      "baseFirst": 16435,
      "baseLast": 12806,
      "year": 2019
    },
    {
      "code": 1625,
      "examType": "ΕΠΑΛ ΕΣΠΕΡΙΝΑ",
      "specialCat": "ΕΠΑΛ ΓΕΝΙΚΗ ΣΕΙΡΑ ΕΣΠ.",
      "positions": 2,
      "baseFirst": 6730,
      "baseLast": 6275,
      "year": 2019
    }
}
]}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="bases-dept">Αναζήτηση Βάσεων ανά τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /bases/dept/{dept_id} </p>
                    <p>Επιστρέφει το σύνολο των βάσεων για το τμήμα που αντιστοιχεί στο id που δίνεται.</p>
                    <h3 class="subtitle">Φίλτρα</h3>
                    <p>Εκτός από τα γενικά φίλτρα των βάσεων, στην αναζήτηση ανά τμήμα μπορεί να εφαρμοστει
                    και το παρακάτω:</p>
                    <ul>
                        <li>details=full</li>
                    </ul>
                    <p>Με το φίλτρο details εκτός από τις ήδη υπάρχουσες πληροφορίες, στην απάντηση περιλαμβάνεται
                    το όνομα του τμήματος και το όνομα του πανεπιστημίου στο οποίο ανήκει.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/dept/1625?type=gel-ime-gen&details=full</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{
  "records": [
    {
      "code": 1625,
      "examType": "ΓΕΛ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
      "positions": 160,
      "baseFirst": 16435,
      "baseLast": 12806,
      "year": 2019,
      "deptName": "ΜΗΧΑΝΙΚΩΝ ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΗΛΕΚΤΡΟΝΙΚΩΝ ΣΥΣΤΗΜΑΤΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
      "uniTitle": "Διεθνές Πανεπιστήμιο της Ελλάδος"
    },
    {
      "code": 1625,
      "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 145,
      "baseFirst": 16125,
      "baseLast": 13325,
      "year": 2020,
      "deptName": "ΜΗΧΑΝΙΚΩΝ ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΗΛΕΚΤΡΟΝΙΚΩΝ ΣΥΣΤΗΜΑΤΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
      "uniTitle": "Διεθνές Πανεπιστήμιο της Ελλάδος"
    }
  ]
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="bases-dept-year">Αναζήτηση Βάσεων ανά έτος και τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /bases/{year}/dept/{dept_id} </p>
                    <p>Επιστρέφει το σύνολο των βάσεων για το έτος που δίνεται και για το τμήμα που αντιστοιχεί στο id που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/2020/dept/1625</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{"records": [
{
      "code": 1625,
      "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 145,
      "baseFirst": 16125,
      "baseLast": 13325,
      "year": 2020
    },
    {
      "code": 1625,
      "examType": "ΓΕΛ ΠΑΛΑΙΟ ΗΜΕΡΗΣΙΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΠΑΛΑΙΟ)",
      "positions": 15,
      "baseFirst": 12774,
      "baseLast": 8569,
      "year": 2020
    }
}
]}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="search-parameters">Αναζήτηση βάσεων με παραμέτρους</h3>
                    <p>Το API σας δίνει τη δυνατότητα να αναζητήσετε βάσεις δίνοντας ως παραμέτρους την μέγιστη/ελάχιστη βάση εισαγωγής,
                    ένα ερώτημα αναζήτησης (π.χ. πληροφορική) ή/και το έτος που επιθυμείτε.</p>
                    <p>Στα παρακάτω είναι υποχρεωτική η χρήση του φίλτρου details=full.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="search-parameters-base-dept-year">Αναζήτηση με παραμέτρους: βάση εισαγωγής, τμήμα, έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/bases/search/?base={base}&department={search_query}&year={year}&=details=full</p>
                    <p>Επιστρέφει όλες τις βάσεις που αντιστοιχούν στο έτος και μικρότερες απο την τιμή της βάσης που δόθηκε, καθώς και
                    και στο ερώτημα αναζήτησης.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/search/?base=15000&department=πληροφορική&year=2020&details=full&type=gel-ime-gen</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{
      "code": 215,
      "examType": "ΠΑΝ. ΠΑΤΡΩΝ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 167,
      "baseFirst": 18700,
      "baseLast": 13575,
      "year": 2020,
      "deptName": "ΜΗΧΑΝΙΚΩΝ ΗΛΕΚΤΡΟΝΙΚΩΝ ΥΠΟΛΟΓΙΣΤΩΝ ΚΑΙ ΠΛΗΡΟΦΟΡΙΚΗΣ (ΠΑΤΡΑ)",
      "uniTitle": "Πανεπιστήμιο Πατρών"
    },
    {
      "code": 340,
      "examType": "ΠΑΝ. ΙΩΑΝΝΙΝΩΝ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 175,
      "baseFirst": 16850,
      "baseLast": 12425,
      "year": 2020,
      "deptName": "ΜΗΧΑΝΙΚΩΝ ΗΛΕΚΤΡΟΝΙΚΩΝ ΥΠΟΛΟΓΙΣΤΩΝ ΚΑΙ ΠΛΗΡΟΦΟΡΙΚΗΣ (ΙΩΑΝΝΙΝΑ)",
      "uniTitle": "Πανεπιστήμιο Ιωαννίνων"
    }</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="search-parameters-base-dept">Αναζήτηση με παραμέτρους: βάση εισαγωγής, τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/bases/search/?base={base}&department={search_query}&=details=full</p>
                    <p>Επιστρέφει όλες τις βάσεις που αντιστοιχούν σε βάσεις εισαγωγής μικρότερες από την τιμή της βάσης που δόθηκε, καθώς και
                        και στο ερώτημα αναζήτησης.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/search/?base=18500&department=ιατρική&details=full&type=gel-ime-gen</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{
      "code": 297,
      "examType": "ΑΠΘ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ. (ΝΕΟ)",
      "positions": 119,
      "baseFirst": 19650,
      "baseLast": 18075,
      "year": 2020,
      "deptName": "ΙΑΤΡΙΚΗΣ (ΘΕΣΣΑΛΟΝΙΚΗ)",
      "uniTitle": "Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης"
    },
    {
      "code": 299,
      "examType": "ΠΑΝ. ΠΑΤΡΩΝ",
      "specialCat": "90% ΓΕΝΙΚΗ  ΣΕΙΡΑ",
      "positions": 135,
      "baseFirst": 19481,
      "baseLast": 18449,
      "year": 2013,
      "deptName": "ΙΑΤΡΙΚΗΣ (ΠΑΤΡΑ)",
      "uniTitle": "Πανεπιστήμιο Πατρών"
    }</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="search-parameters-base-year">Αναζήτηση με παραμέτρους: βάση εισαγωγής, έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/bases/search/?base={base}&year={year}&=details=full</p>
                    <p>Επιστρέφει όλες τις βάσεις που αντιστοιχούν σε βάσεις εισαγωγής μικρότερες από την τιμή της βάσης που δόθηκε, καθώς και
                        και στο έτος που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/search/?base=12000&year=2018&details=full&type=gel-ime-gen</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{
      "code": 101,
      "examType": "ΕΚΠΑ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
      "positions": 215,
      "baseFirst": 15279,
      "baseLast": 10675,
      "year": 2018,
      "deptName": "ΘΕΟΛΟΓΙΑΣ (ΑΘΗΝΑ)",
      "uniTitle": "Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών"
    },
    {
      "code": 102,
      "examType": "ΠΑΝ. ΠΑΤΡΩΝ",
      "specialCat": "ΓΕΛ ΓΕΝIKH ΣΕΙΡΑ ΗΜ.",
      "positions": 162,
      "baseFirst": 18223,
      "baseLast": 11989,
      "year": 2018,
      "deptName": "ΦΙΛΟΣΟΦΙΑΣ (ΠΑΤΡΑ)",
      "uniTitle": "Πανεπιστήμιο Πατρών"
    }</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="base-data">Ελάχιστο και Μέγιστο Έτος Δεδομένων Βάσεων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/bases/?year=min</p>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/bases/?year=max</p>
                    <p>Μπορείτε να αναζητήσετε το ελάχιστο και το μέγιστο έτος των
                    δεδομένων που προσφέρονται για τις βάσεις με τα παρακάτω φίλτρα:</p>
                    <ul>
                        <li>year=min</li>
                        <li>year=max</li>
                    </ul>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/bases/?year=min</code></pre>
                        <div class="code-title">
                            Τυπική Απάντηση
                        </div>
                        <pre><code class="language-json">{
  "minYear": 2013
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="depts">Τμήματα</h3>
                    <p>Τα Τμήματα των ανώτατων εκπαιδευτικών ιδρυμάτων μπορούν να
                        ανακτηθούν ως σύνολο, με αναζήτηση του id τους. Επίσης δίνεται
                        η δυνατότητα ανάκτησης Τμημάτων ανά Πανεπιστήμιο.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="all-depts">Σύνολο Τμημάτων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /departments </p>
                    <p>Επιστρέφει το σύνολο των τμημάτων από όλα τα ιδρύματα.</p>
                    <p>Για το σύνολο των τμημάτων προσφέρεται και το φίλτρο:</p>
                    <ul><li>details=full</li></ul>
                    <p>Αυτό το φίλτρο προσθέτει στα αποτελέσματα τον σύντομο και ολόκληρο των τίτλο
                    του πανεπιστήμιου που ανήκει κάθε τμήμα.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Μέρος Τυπικής Απάντησης
                        </div>
                        <pre><code class="language-json">[
{
  "code": 97,
  "name": "ΟΙΚΟΝΟΜΙΚΩΝ ΕΠΙΣΤΗΜΩΝ (ΚΟΜΟΤΗΝΗ)",
  "uni-id": 96118
},
{
  "code": 98,
  "name": "ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΤΗΛΕΠΙΚΟΙΝΩΝΙΩΝ (ΤΡΙΠΟΛΗ)",
  "uni-id": 96409
},
{
  "code": 99,
  "name": "ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΤΗΛΕΠΙΚΟΙΝΩΝΙΩΝ (ΛΑΜΙΑ)",
  "uni-id": 96283
}
]                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="search-depts">Αναζήτηση Τμήματος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /departments/{dept_id} </p>
                    <p>Επιστρέφει το Τμήμα που αντιστοιχεί στο id που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερώτησης
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/departments/1625</code></pre>
                        <div class="code-title">
                            Παράδειγμα Απάντησης
                        </div>
                        <pre><code class="language-json">{
  "code": "1625",
  "title": "ΜΗΧΑΝΙΚΩΝ ΠΛΗΡΟΦΟΡΙΚΗΣ ΚΑΙ ΗΛΕΚΤΡΟΝΙΚΩΝ ΣΥΣΤΗΜΑΤΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
  "uni-id": 96087
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="uni-depts">Αναζήτηση Τμημάτων ανά Πανεπιστήμιο</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /departments/university/{uni_id} </p>
                    <p>Επιστρέφει το σύνολο των Τμημάτων που ανήκουν στο Πανεπιστήμιο που αντιστοιχεί στο id.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερώτησης
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/departments/university/96025</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">[
{
    "code": 233,
    "name": "ΑΡΧΙΤΕΚΤΟΝΩΝ ΜΗΧΑΝΙΚΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
    "uni-id": 96025
  },
  {
    "code": 237,
    "name": "ΧΗΜΙΚΩΝ ΜΗΧΑΝΙΚΩΝ (ΘΕΣΣΑΛΟΝΙΚΗ)",
    "uni-id": 96025
  }
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="exam-types">Τύποι Εξετάσεων</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /examtypes </p>
                    <p>Οι διαφορετικοί τύποι εξετάσεων μπορούν να ανακτηθούν ως σύνολο.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Μέρος Τυπικής Απάντησης
                        </div>
                        <pre><code class="language-json">[
  {
    "title": "10% ΕΠΑΛΑ 2016",
    "description": null
  },
  {
    "title": "ΓΕΛ ΕΣΠΕΡΙΝΑ",
    "description": null
  },
  {
    "title": "ΓΕΛ ΗΜΕΡΗΣΙΑ",
    "description": null
  }
]                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="special-categories">Ειδικές Κατηγορίες</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /special-categories </p>
                    <p>Οι διαφορετικές Ειδικές Κατηγορίες μπορούν να ανακτηθούν ως σύνολο.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Μέρος Τυπικής Απάντησης
                        </div>
                        <pre><code class="language-json">[
  {
    "code": 101,
    "title": "90% ΕΙΔ.ΠΕΡ. ΤΡΙΤΕΚΝΟΙ (ΕΣΠ)"
  },
  {
    "code": 817,
    "title": "10% ΑΕΝ ΕΙΔ.ΚΑΤ.ΠΟΛΥΤΕΚΝΟΙ ΑΠΟΦ. 2014"
  }
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics">Στατιστικά</h3>
                    <p>Το API διαθέτει ένα σύνολο δυνατοτήτων ανάκτησης στατιστικών με βάση το έτος,
                    το τμήμα, το πανεπιστήμιο και την κατηγορία.</p>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-year">Αναζήτηση Στατιστικών ανά έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/{year}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για τό έτος που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/2020</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  {
    "code": 97,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 0,
    "preference": 1,
    "count": 3,
    "year": 2020
  },
  {
    "code": 97,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 0,
    "preference": 2,
    "count": 1,
    "year": 2020
  }
]
                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-dept">Αναζήτηση Στατιστικών ανά τμήμα</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/department/{dept_id}</p>
                    <p>Επιστρέφει το σύνολο το στατιστικών για το τμήμα που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/department/1625</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 0,
    "preference": 1,
    "count": 5,
    "year": 2020
  },
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 0,
    "preference": 2,
    "count": 3,
    "year": 2020
  }
]
                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-university">Αναζήτηση Στατιστικών ανά πανεπιστήμιο</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/university/{uni_id}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για το πανεπιστήμιο που αντιστοιχεί στο id που
                    δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/university/96087</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  [
    {
      "code": 103,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 1,
      "count": 2,
      "year": 2020
    },
    {
      "code": 103,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 2,
      "count": 7,
      "year": 2020
    }
  ]
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-year-category">Αναζήτηση Στατιστικών ανά έτος και κατηγορία</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/{year}/category/{category}</p>
                    <p>Επιστρέφει το σύνολο το στατιστικών που αντιστοιχούν στό έτος και την κατηγορία που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/2020/category/0</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
{
    "code": 270,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2019",
    "category": 0,
    "preference": 7,
    "count": 417,
    "year": 2020
  },
  {
    "code": 270,
    "examType": "ΓΕΛ ΝΕΟ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ",
    "category": 0,
    "preference": 1,
    "count": 93,
    "year": 2020
  }
]                            </code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-year-university">Αναζήτηση Στατιστικών ανά έτος και πανεπιστήμιο</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/{year}/university/{uni_id}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών που αντιστοιχούν στο έτος και στο πανεπιστήμιο που δόθηκε.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/2020/university/96087</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  [
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 1,
      "count": 2,
      "year": 2020
    },
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 2,
      "count": 5,
      "year": 2020
    }
  ]
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-university-category">
                        Αναζήτηση Στατιστικών ανά πανεπιστήμιο και κατηγορία
                    </h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>
                        /statistics/university/{uni_id}/category/{category}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για το πανεπιστήμιο και τη
                    κατηγορία που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/university/96087/category/1</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  [
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 1,
      "preference": 1,
      "count": 1,
      "year": 2020
    },
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 1,
      "preference": 2,
      "count": 1,
      "year": 2020
    }
  ]
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-department-category">
                        Αναζήτηση Στατιστικών ανά τμήμα και κατηγορία
                    </h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>
                        /statistics/department/{dept_id}/category/{category}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για το τμήμα και τη
                        κατηγορία που δίνεται.</p>
                    <h3 class="subtitle">Φίλτρα</h3>
                    <p>Εκτός από τα γενικά φίλτρα των στατιστικών, στην αναζήτηση ανά τμήμα και κατηγορία
                        μπορούν να εφαρμοστούν και τα παρακάτω:</p>
                    <ul>
                        <li>type=gel-ime-gen</li>
                        <p>Επιστρέφει τα στατιστικά που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 90% ημερήσιων ΓΕΛ</p>
                        <li>type=epal-ime-gen</li>
                        <p>Επιστρέφει τα στατιστικά που αντιστοιχούν στα αποτελέσματα σχετικά με την κατηγορία 90% ημερήσιων ΕΠΑΛ</p>
                    </ul>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/department/1625/category/1</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 1,
    "preference": 1,
    "count": 1,
    "year": 2020
  },
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 1,
    "preference": 2,
    "count": 1,
    "year": 2020
  }
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-year-department-category">
                        Αναζήτηση Στατιστικών ανά έτος, τμήμα και κατηγορία
                    </h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>
                        /statistics/{year}/department/{dept_id}/category/{category}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για το έτος, το τμήμα και τη
                        κατηγορία που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/2020/department/1625/category/1</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 1,
    "preference": 1,
    "count": 1,
    "year": 2020
  },
  {
    "code": 1625,
    "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
    "category": 1,
    "preference": 2,
    "count": 1,
    "year": 2020
  }
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 class="subtitle" id="statistics-year-university-category">
                        Αναζήτηση Στατιστικών ανά έτος, πανεπιστήμιο και κατηγορία
                    </h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>
                        /statistics/{year}/university/{uni_id}/category/{category}</p>
                    <p>Επιστρέφει το σύνολο των στατιστικών για το έτος, το πανεπιστήμιο και τη
                        κατηγορία που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">Παράδειγμα Ερωτήματος</div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/2020/university/96087/category/1</code></pre>
                        <div class="code-title">Μέρος Απάντησης</div>
                        <pre><code class="language-json">[
  [
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 1,
      "count": 2,
      "year": 2020
    },
    {
      "code": 1601,
      "examType": "10% ΓΕΛ ΗΜΕΡΗΣΙΑ & ΕΣΠΕΡΙΝΑ 2018",
      "category": 0,
      "preference": 2,
      "count": 5,
      "year": 2020
    }
  ]
]</code></pre>
                    </div>
                </div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h3 id="stats-data">Ελάχιστο και Μέγιστο Έτος Δεδομένων Στατιστικών</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/?year=min</p>
                    <p class="api-endpoint"><span class="http-verb">GET</span>/statistics/?year=max</p>
                    <p>Μπορείτε να αναζητήσετε το ελάχιστο και το μέγιστο έτος των
                        δεδομένων που προσφέρονται για τα στατιστικά με τα παρακάτω φίλτρα:</p>
                    <ul>
                        <li>year=min</li>
                        <li>year=max</li>
                    </ul>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">https://vaseis.iee.ihu.gr/api/index.php/statistics/?year=min</code></pre>
                        <div class="code-title">
                            Τυπική Απάντηση
                        </div>
                        <pre><code class="language-json">{
  "minYear": 2016
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/vaseis-app/js/vendor/prism.js"></script>
    <script src="/vaseis-app/js/api.js"></script>
</body>
</html>
