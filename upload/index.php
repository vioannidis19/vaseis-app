<?php
    require '../src/upload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Εισαγωγή Βάσεων και Στατιστικών Πανελλαδικών Εξετάσεων</h1>
<p style="color:red; font-weight:red;">Το αρχείο των βάσεων θα πρέπει να είναι της μορφής vaseis.{έτος}.csv και των στατιστικών stats.{έτος}.csv</p>

<form method="post" enctype="multipart/form-data">
    <h3>Αρχείο Βάσεων</h3>
    <input type="file" name="vaseis" id="">
    <h3>Αρχείο Στατιστικών</h3>
    <input type="file" name="stats" id="">
    <br><br>
    <input type="submit" value="Υποβολή" name="submit">
</form>

<h2>Μορφή Αρχείων</h2>
<h3>Αρχείο Βάσεων</h3>
<p>Το csv αρχείο θα πρέπει να είναι της μορφής code,uni,dept,vasiprotou,vasitel,examtype</p>
<h3>Αρχείο Στατιστικών</h3>
<p>Το csv αρχείο θα πρέπει να της μορφής code, protimisi1,protimisi2,protimisi3,protimisi4,protimisi5,protimisi6,promisiAllo,examtype</p>
<p>Για τα στατιστικά των υποψηφίων τα protimisi4,protimis5,protimisi6 μένουν κένα.</p>
</body>
</html>