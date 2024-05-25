<?php
require 'db.php';  // Assuming you have the DB class from the previous message

$bdd = DB::getInstance();

// Safely get POST variables
$idp = $_POST['idp'] ?? null;
$nom = $_POST['nom'] ?? null;
$prenom = $_POST['prenom'] ?? null;
$email = $_POST['email'] ?? null;
$pays = $_POST['pays'] ?? null;
$date = date('Y-m-d');
$heure = date('H:i:s');

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $email !== null) {
    echo 'Error: Invalid email format.';
    exit; // Stop further processing if email is invalid
}

// Prepare and execute the query
$requete = $bdd->prepare('INSERT INTO signature (IDP, Nom, Prenom, Email, Pays, Date, Heure) VALUES (?, ?, ?, ?, ?, ?, ?)');

// Check if all required fields are provided
if ($idp && $nom && $prenom && $email && $pays) {
    if ($requete->execute([$idp, $nom, $prenom, $email, $pays, $date, $heure])) {
        echo 'OK';
    } else {
        echo 'Database insertion failed.';
    }
} else {
    echo 'Error: Missing required fields.';
}
?>
