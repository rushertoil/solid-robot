<?php
// Connexion à la base de données
$connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $type_client = $_POST['type_client'];

    // Vérification si le client existe déjà dans la base de données
    $query = $connexion->prepare("SELECT * FROM Client WHERE nom = ?");
    $query->execute([$nom]);
    $existing_client = $query->fetch();

    if ($existing_client) {
        // Le client existe déjà, mettez à jour ses informations
        $query = $connexion->prepare("UPDATE Client SET prenom = ?, adresse = ?, id_type_de_client = ? WHERE nom = ?");
        $query->execute([$prenom, $adresse, $type_client, $nom]);
        echo "Les informations du client ont été mises à jour avec succès.";
    } else {
        // Le client n'existe pas, insérez les nouvelles informations dans la base de données
        $query = $connexion->prepare("INSERT INTO Client (nom, prenom, adresse, id_type_de_client) VALUES (?, ?, ?, ?)");
        $query->execute([$nom, $prenom, $adresse, $type_client]);
        echo "Nouveau client ajouté avec succès.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="image.png" alt="Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="html.php">Accueille</a></li>
                <li><a href="php2.php">Stock de véhicule</a></li>
                <li><a href="php4.php">Ajouter véhicule</a></li>
                <li><a href="php3.php">Ajouter client</a></li>
                <li><a href="#">Historique</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
        <h1>Ajouter un Client</h1>
        <form method="post" action="php3.php">
            <div class="input-group">
                <label for="nom">Nom de famille:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="input-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="input-group">
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>
            <div class="input-group">
                <label for="type_de_client">Type de client:</label>
                <select id="type_de_client" name="type_de_client" required>
                    <option value="1">Particulier</option>
                    <option value="2">Entreprise</option>
                    <option value="3">Administration</option>
                    <option value="4">Association</option>
                    <option value="5">Longue durée</option>
                </select>
            </div>
            <input type="submit" value="Ajouter Client">
            <button type="button" name="deja_venu">Déjà venu</button>
        </form>
    </div>
</body>
</html>
