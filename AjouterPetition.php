<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une pétition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 300px; /* Reduced width */
            margin: auto; /* Center form on the page */
        }

        label {
            margin: 10px 0 5px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #007bff; /* Changed to blue */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Ajouter une pétition</h1>
    <form id="ajoutPetition" method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre">

        <label for="description">Description :</label>
        <textarea id="description" name="description"></textarea>

        <label for="date_public">Date de publication :</label>
        <input type="date" id="date_public" name="date_public">

        <label for="date_fin">Date de fin :</label>
        <input type="date" id="date_fin" name="date_fin">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom">

        <button type="submit">Ajouter</button>
    </form>
    <p>Pétition la plus signée : <span id="petitionPlusSignee"></span></p>

    <script>
        function submitForm(event) {
            event.preventDefault();
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200 && xhr.responseText === 'OK') {
                        alert('La pétition a été ajoutée avec succès !');
                        document.getElementById('ajoutPetition').reset();
                        fetchMostSignedPetition();
                    } else {
                        alert('Une erreur est survenue, la pétition n\'a pas pu être ajoutée.');
                    }
                }
            };
            xhr.open('POST', 'AjouterPetitionTrait.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            var formData = new FormData(document.getElementById('ajoutPetition'));
            xhr.send(new URLSearchParams(formData).toString());
        }

        function fetchMostSignedPetition() {
            var xhr2 = new XMLHttpRequest();
            xhr2.onreadystatechange = function() {
                if (xhr2.readyState === XMLHttpRequest.DONE) {
                    if (xhr2.status === 200) {
                        document.getElementById('petitionPlusSignee').textContent = xhr2.responseText;
                    } else {
                        console.error('Erreur : impossible de récupérer la pétition la plus signée.');
                    }
                }
            };
            xhr2.open('GET', 'PetitionPlusSignee.php');
            xhr2.send();
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('ajoutPetition').addEventListener('submit', submitForm);
        });

        function getLatestPetition() {
            var evtSource = new EventSource('DernierePetition.php');
            evtSource.addEventListener('nouvelle-petition', function(event) {
                var latestPetition = event.data.trim();
                if (latestPetition !== '') {
                    alert('Une nouvelle pétition a été ajoutée: ' + latestPetition);
                }
            });
        }

        getLatestPetition();
    </script>
</body>
</html>
