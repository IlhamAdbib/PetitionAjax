<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=petition;charset=utf8', 'root', '');
} catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Requête pour récupérer toutes les pétitions
$requete = $bdd->query('SELECT * FROM petition');

?>

<head>
    <meta charset="utf-8">
    <title>Liste des pétitions</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
    <style>
        /* General body styles */
        body {
            font-family: 'Roboto', sans-serif; /* Modern font */
            background-color: #f7f7f7; /* Lighter grey background */
            margin: 0;
            padding: 0;
            color: #333; /* Darker font color for better readability */
        }

        /* Main content area styling */
        main {
            max-width: 960px; /* Slightly wider main area */
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        /* Header styles */
        h1 {
            background-color: #3498db; /* Softer blue */
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px; /* Adds space between title and table */
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd; /* Lighter line color */
        }

        th {
            background-color: #2980b9; /* Deeper blue */
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1; /* Subtle hover effect */
        }

        /* Link styles */
        a {
            color: #2980b9;
            text-decoration: none; /* No underline */
            transition: color 0.3s;
        }

        a:hover {
            color: #3498db; /* Lighter blue on hover */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            main {
                padding: 10px;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
<main>
    <h1>Liste des pétitions</h1>

    <table>
        <thead>
        <tr>
            <th>IDP</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Description</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Titre</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Boucle pour afficher toutes les pétitions
        while($petition = $requete->fetch()) {
            echo '<tr>';
            echo '<td>' . $petition['IDP'] . '</td>';
            echo '<td>' . $petition['Nom'] . '</td>';
            echo '<td>' . $petition['Prenom'] . '</td>';
            echo '<td>' . $petition['Description'] . '</td>';
            echo '<td>' . $petition['DatePublic'] . '</td>';
            echo '<td>' . $petition['DateFin'] . '</td>';
            echo '<td>' . $petition['Titre'] . '</td>';
            echo '<td><a href="signature.php?idp=' . $petition['IDP'] . '">Signer</a></td>'; // Lien vers le formulaire de signature avec l'IDP de la pétition en paramètre
            echo '</tr>';
        }
        $requete->closeCursor(); // Libère la connexion
        ?>
        </tbody>
    </table>
</main>
</body>
</html>
