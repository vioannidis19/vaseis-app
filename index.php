<?php
require $_SERVER["DOCUMENT_ROOT"] . '/vaseis-app/src/public/home.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.jpg">
    <title>Αρχική Σελίδα | vaseis-app</title>
    <script src="https://kit.fontawesome.com/cd008643b6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    
<!-- Global site tag (gtag.js) - Google Analytics -->


    
</head>
<body>
    <div class="cookie-consent">
        <p>Αυτός ο ιστότοπος χρησιμοποιεί cookies για καλύτερη φυλλομέτρηση. <a href="">Δείτε πως χρησιμοποιούμε
            τα cookies και πως μπορείτε να αλλάξετε τις ρυθμίσεις σας.</a></p>
        <div class="button-container">
            <input type="button" value="Αποδέχομαι τα cookies" class="cookies-accept">
            <input type="button" value="Δεν αποδέχομαι τα cookies" class="cookies-deny">
        </div>
    </div>
    <div class="container" id="home">
        <div class="hidden bg"></div>
        <div class="landing">
			<!--
            <div class="nav-bar">
                <ul>
                    <li><a href="#info">Πληροφορίες</a></li>
                    <li><a href="#api">API</a></li>
                </ul>
            </div>
            -->
            <div class="landing-window">
                <img src="./img/logo.png" alt="vaseis-app API logo">
                <a href="#info"><input type="button" value="Δείτε περισσότερα"></a>
            </div>
            <div class="landing-text">
                <h2 class="title">vaseis-app</h2>
                <h4 class="subtitle">Δείτε και συγκρίνετε εύκολα την εξέλιξη των βάσεων εισαγωγής 
                των τμημάτων ΑΕΙ μέσω των Πανελλαδικών Εξετάσεων!</h4>
            </div>
            <div class="form-container">
                <form method="get" autocomplete="off">
                    <div class="tree-view-container">
                        <div class="close-btn">✓</div>
                        <div class="tree-view">
                            <div class="filter-container">
                                <label for="filter-input">Φίλτρο</label>
                                <input type="text" class="filter-input" name="filter-input" placeholder="Εφαρμογή Φίλτρου">
                                <input type="button" value="Επιλογή όλων" class="select-all btn-disabled" disabled>
<!--                                <input type="submit" value="Αναζήτηση" class="filter-button">-->
                            </div>
                            <div class="search-dept-list">
                                <?php fillList() ?>
                            </div>
                        </div>
                    </div>
                    <input type="button" value="Επιλέξτε Ιδρύματα/Τμήματα" class="selector">
                    <span class="dept-selected-label">0 τμήματα επιλεγμένα</span>
                    <div class="submit-btn-container">
                        <input type="submit" value="Αναζήτηση" class="submit-btn">
                    </div>
                </form>
            </div>

        </div>
        <div class="section-info" id="info">
            <!--
            <div class="subtitle">
                <h4>Πληροφορίες</h4>
            </div>
            -->
            <div class="column-container">
                <div class="section-column">
                    <h5>Η σύγκριση βάσεων έγινε εύκολη!</h5>
                    <i class="fas fa-chart-area"></i>
                    <p>Βρείτε εύκολα το ιστορικό των βάσεων των τμημάτων ΑΕΙ,
                    συγκρίνετε με άλλα τμήματα και δείτε διαγράμματα εξέλιξης των βάσεων με την πάροδο των ετών. Ενημερωθείτε 
                    για το πλήθος εισακτέων και για τα μόρια που συγκέντρωσε ο εισακτέος με τη μεγαλύτερη βαθμολογία</p>
					<div class="cta-top">
						<a href="#home"><input type="button" value="Ψάξτε τώρα"></a>
					</div>                    
                </div>
                <div class="section-column">
                    <h5>Στατιστικά τμημάτων</h5>
                    <i class="fas fa-list-ol"></i>
                    <p>Δείτε στατιστικά των προτιμήσεων για κάθε τμήμα. Εντοπίστε εύκολα τη δημοφιλια του κάθε τμήματος βάσει 
                    διαγραμμάτων που δημιουργούνται βάσει των προτιμήσεων στα μηχανογραφικά δελτία</p>
					<div class="cta-top stats-cta">
						<a href="#home"><input type="button" value="Ψάξτε τώρα"></a>
					</div>                    
                </div>
               
                <div class="section-column">
                    <h5>Web API</h5>
                    <i class="fas fa-code"></i>
                    <p >Το vaseis-app προσφέρει ένα ελεύθερο API, με το οποίο μπορείτε
                        να ανακτήσετε σε μορφή JSON οποιαδήποτε πληροφορία επιθυμείτε σχετικά με τις βάσεις εισαγωγής στα τμήματα της 
                        Τριτοβάθμιας Εκπαίδευσης για τη δικιά σας εφαρμογή.</p>
                         <div class="cta-top">
							<a href="api"><input type="button" value="Δείτε το API"></a>
						 </div>	
                </div>                
                <div class="section-column">
                    <h5>Μια υπηρεσία του</h5>
                    <img src="./img/ihu3.png" style="margin-bottom:10px;width: 75px;"/>
                    <p class="footer-text"><a href="https://imselab.iee.ihu.gr/">Εργαστηρίου Διαχείρισης Πληροφορίας και Μηχανικής Λογισμικού</a><br/><br/>
                    του  <a href="https://www.iee.ihu.gr">Τμήματος Μηχανικών Πληροφορικής και Ηλεκτρονικών Συστημάτων</a> <br/><br/> του  <a href="https://www.ihu.gr">Διεθνούς Πανεπιστημίου της Ελλάδος</a>
                    
                    </p>
                </div>                  
               
               
            </div>
        </div>
       
        <footer>
            <div class="footer">

             
                <span class="footer-text">
                    Ανάπτυξη Εφαρμογής και API: Βασίλης Ιωαννίδης [info(at)vioannidis(dot)com], Καθοδήγηση: <a href="https://www.iee.ihu.gr/~stoug">Στέφανος Ουγιάρογλου</a>
                </span>
              
            </div>
        </footer>
    </div>
    <script src="js/home.js"></script>
</body>
</html>
