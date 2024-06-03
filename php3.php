<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='message error'>Erreur de connexion : " . $e->getMessage() . "</div>";
    exit();
}
if (isset($_POST['add_client'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $id_type_client = $_POST['id_type_client'];

    $sql = "INSERT INTO client (nom, prenom, adresse, id_type_client) VALUES (:nom, :prenom, :adresse, :id_type_client)";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':id_type_client', $id_type_client);

    if ($stmt->execute()) {
        echo "<div class='message success'>Nouveau client ajouté avec succès</div>";
    } else {
        echo "<div class='message error'>Erreur lors de l'ajout du client</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Ajouter un client</h1>
        </div>
    </header>
    <div class="container main">
        <form method="post">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom" required><br>
            <label for="prenom">Prénom:</label><br>
            <input type="text" id="prenom" name="prenom" required><br>
            <label for="adresse">Adresse:</label><br>
            <input type="text" id="adresse" name="adresse" required><br>
            <label for="id_type_client">Type de client:</label><br>
            <select id="id_type_client" name="id_type_client" required>
                <option value="1">Particulier</option>
                <option value="2">Entreprise</option>
                <option value="3">Administration</option>
                <option value="4">Association</option>
                <option value="5">Longue durée</option>
            </select><br><br>
            <input type="submit" name="add_client" value="Ajouter">
        </form>
    </div>
</body>
</html>
