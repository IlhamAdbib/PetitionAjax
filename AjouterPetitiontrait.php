<?php
// connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=petition;charset=utf8', 'root', '');
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// récupération des données du formulaire
$titre = $_POST['titre']?? null;
$description = $_POST['description']?? null;
$datePublic = $_POST['date_public']?? null;
$dateFin = $_POST['date_fin']?? null;
$nom = $_POST['nom']?? null;
$prenom = $_POST['prenom']?? null;


// insertion des données dans la table Petition
$requete = $bdd->prepare('INSERT INTO petition (Nom, Prenom, Description, DatePublic, DateFin, Titre) VALUES (?, ?, ?, ?, ?, ?)');
if ($requete->execute(array($nom, $prenom, $description, $datePublic, $dateFin, $titre))) {
    // réponse envoyée au client si l'ajout s'est bien déroulé
    echo 'OK';
} else {
    // réponse envoyée au client si l'ajout s'est mal déroulé
    echo 'NotOK';
}
?>
