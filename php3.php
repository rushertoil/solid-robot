<?php
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<div class='message error'>Erreur de connexion : " . $e->getMessage() . "</div>";
        exit();
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'Enregistrer') {
        $nom = $conn->real_escape_string($_POST['nom']);
        $prenom = $conn->real_escape_string($_POST['prenom']);
        $adresse = $conn->real_escape_string($_POST['adresse']);
        $type = (int) $_POST['type'];

        $sql = "INSERT INTO client (nom, prenom, adresse, id_type_de_client) VALUES ('$nom', '$prenom', '$adresse', '$type')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Nouveau client enregistré avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'Supprimer') {
        $id_client = (int) $_POST['id_client'];

        $sql = "DELETE FROM client WHERE id_client = $id_client";
        
        if ($conn->query($sql) === TRUE) {
            echo "Client supprimé avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    }
}   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<header>
        <div class="logo">
            <img src="image.png" alt="Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="html.php">Accueil</a></li>
                <li><a href="php2.php">Stock de véhicule</a></li>
                <li><a href="php4.php">Ajouter véhicule</a></li>
                <li><a href="php3.php">Ajouter client</a></li>
                <li><a href="php5.php">Historique</a></li>
            </ul>
        </nav>
    </header>
<body>
    <h1>Gestion des Clients</h1>
    <form action="process.php" method="post">
        <h2>Enregistrer un nouveau client</h2>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>
        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required><br>
        <label for="type">Type de client:</label>
        <select id="type" name="type">
            <option value="1">Particulier</option>
            <option value="2">Entreprise</option>
            <option value="3">Administration</option>
            <option value="4">Association</option>
            <option value="5">Longue durée</option>
        </select><br>
        <input type="submit" name="action" value="Enregistrer">
    </form>

    <form action="process.php" method="post">
        <h2>Supprimer un client</h2>
        <label for="id_client">ID du client:</label>
        <input type="number" id="id_client" name="id_client" required><br>
        <input type="submit" name="action" value="Supprimer">
    </form>
</body>
</html>
