<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vaseis-app API</title>
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
                    <li class="section-item">
                        <a href="#authorization">Ταυτοποίηση</a>
                    </li>
                    <li class="section-item">
                        <a href="#errors">Σφάλματα</a>
                    </li>
                    <li class="section-item list-title">Endpoints</li>
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
                    <li class="section-item"><a href="#depts">Τμήματα</a></li>
                    <li class="section-item"><a href="#all-depts">Σύνολο Τμημάτων</a></li>
                    <li class="section-item"><a href="#search-depts">Αναζήτηση Τμήματος</a></li>
                    <li class="section-item"><a href="#uni-depts">Αναζήτηση Τμημάτων ανά πανεπιστήμιο</a></li>
                    <li class="section-item"><a href="#exam-types">Τύποι Εξετάσεων</a></li>
                    <li class="section-item"><a href="#">Σύνολο Τύπων Εξετάσεων</a></li>
                    <li class="section-item"><a href="#special-categories">Ειδικές Κατηγορίες</a></li>
                    <li class="section-item"><a href="#">Σύνολο Ειδικών Κατηγοριών</a></li>
                    <li class="section-item"><a href="#statistics">Στατιστικά</a></li>
                    <li class="section-item"><a href="#">Αναζήτηση Στατιστικών ανά έτος</a></li>
                    <li class="section-item"><a href="#">Αναζήτηση Στατιστικών ανά κατηγορία</a></li>
                    <li class="section-item"><a href="#">Αναζήτηση Στατιστικών ανά τμήμα</a></li>
                    <li class="section-item"><a href="#">Αναζήτηση Στατιστικών ανά πανεπίστημιο</a></li>
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
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Αρχικό URL
                        </div>
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api</code></pre>
                    </div>
                </div>
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
                    <h3 class="subtitle" id="errors">Σφάλματα</h3>
                </div>
                <div class="section-item"></div>
            </div>
            <div class="section-container">
                <div class="section-item">
                    <h2 class="title">Endpoints</h2>
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
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/universities/96025</code></pre>
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
                    <h3 class="subtitle" id="bases-year">Αναζήτηση Βάσεων ανά έτος</h3>
                    <p class="api-endpoint"><span class="http-verb">GET</span> /bases/{year} </p>
                    <p>Επιστρέφει το σύνολο των βάσεων για το έτος που δίνεται.</p>
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/bases/2019</code></pre>
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
                </div>
                <div class="section-item">
                    <div class="code-container">
                        <div class="code-title">
                            Παράδειγμα Ερωτήματος
                        </div>
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/bases/dept/338</code></pre>
                        <div class="code-title">
                            Μέρος Απάντησης
                        </div>
                        <pre><code class="language-json">{"records": [
{
      "code": 338,
      "examType": "10% ΓΕΛ, ΕΠΑΛΒ 2016",
      "specialCat": "10% ΓΕΛ,ΕΠΑΛΒ ΓΕΝ. ΣΕΙΡΑ 2016",
      "positions": 7,
      "baseFirst": 18598,
      "baseLast": 17235,
      "year": 2017
    },
    {
      "code": 338,
      "examType": "10% ΓΕΛ, ΕΠΑΛΒ 2016",
      "specialCat": "10% ΓΕΛ,ΕΠΑΛΒ ΓΕΝ. ΣΕΙΡΑ 2016",
      "positions": 6,
      "baseFirst": 18089,
      "baseLast": 15625,
      "year": 2018
    }
}
]}</code></pre>
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
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/bases/2020/dept/1625</code></pre>
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
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/departments/1625</code></pre>
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
                        <pre><code class="language-json">127.0.0.1/vaseis-app/api/departments/university/96025</code></pre>
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
                    <p>Η δυνατότητα ανάκτησης στατιστικών μέσω του API δεν έχει
                        υλοποιηθεί ακόμα.</p>
                </div>
                <div class="section-item"></div>
            </div>
        </div>
    </div>
    <script src="/vaseis-app/js/vendor/prism.js"></script>
    <script src="/vaseis-app/js/api.js"></script>
</body>
</html>
