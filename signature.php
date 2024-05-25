<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Signature</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        main {
            background-color: #fff;
            width: 100%; /* Full width with a max-width for larger screens */
            max-width: 400px; /* Limited max width for aesthetic */
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        h1 {
            color: #2980b9;
            text-align: center;
            font-size: 24px; /* Slightly larger font size for the header */
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px; /* Reduced margin for a tighter layout */
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%; /* Full width inputs */
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px; /* Subtle rounding */
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; /* Full width button */
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        textarea {
            resize: none; /* Non-resizable textarea */
            margin-top: 10px; /* Space before the textarea */
        }
    </style>
</head>
<body>
<main>
    <h1>Signature</h1>
    <form id="signature-form" method="post" action="ajouterSignature.php">
        <label for="idp">IDP:</label>
        <input type="text" id="idp" name="idp" required>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="pays">Pays:</label>
        <input type="text" id="pays" name="pays" required>
        <input type="submit" value="Envoyer">
    </form>
    <div id="result"></div>
    <label for="liste-signatures">Cinq dernières signatures:</label>
    <textarea id="liste-signatures" rows="5"></textarea>
</main>
<script>
    $(document).ready(function () {
        $('#signature-form').submit(function (event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function (data) {
                    $('#result').html(data);
                    $('#signature-form')[0].reset();
                    updateListeSignatures();
                }
            });
        });

        function updateListeSignatures() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getLastSignatures.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    $('#liste-signatures').val(xhr.responseText);
                }
            }
            xhr.send();
        }

        updateListeSignatures(); // Updates the list of signatures when the page loads
    });
</script>
</body>
</html>
