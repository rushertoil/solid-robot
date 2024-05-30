<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Voitures et Modèles</title>
</head>
<body>
    <h2>Ajouter un Nouveau Modèle de Voiture</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="ajouter_modele">
        <label for="libelle">Libellé :</label>
        <input type="text" id="libelle" name="libelle" required>

        <label for="id_categorie">Catégorie :</label>
        <input type="text" id="id_categorie" name="id_categorie" required>

        <label for="id_marque">Marque :</label>
        <input type="text" id="id_marque" name="id_marque" required>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image" required>

        <input type="submit" value="Ajouter">
    </form>

    <h2>Ajouter une Nouvelle Voiture</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="ajouter_voiture">
        <label for="immatriculation">Immatriculation :</label>
        <input type="text" id="immatriculation" name="immatriculation" required>

        <label for="compteur">Compteur :</label>
        <input type="number" id="compteur" name="compteur" required>

        <label for="id_modele">ID Modèle :</label>
        <input type="number" id="id_modele" name="id_modele" required>

        <input type="submit" value="Ajouter">
    </form>

    <h2>Modifier une Voiture</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="modifier_voiture">
        <label for="id_voiture">ID Voiture :</label>
        <input type="number" id="id_voiture" name="id_voiture" required>

        <label for="immatriculation">Immatriculation :</label>
        <input type="text" id="immatriculation" name="immatriculation">

        <label for="compteur">Compteur :</label>
        <input type="number" id="compteur" name="compteur">

        <label for="id_modele">ID Modèle :</label>
        <input type="number" id="id_modele" name="id_modele">

        <input type="submit" value="Modifier">
    </form>

    <h2>Supprimer une Voiture</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="supprimer_voiture">
        <label for="id_voiture">ID Voiture :</label>
        <input type="number" id="id_voiture" name="id_voiture" required>

        <input type="submit" value="Supprimer">
    </form>

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

        switch ($action) {
            case 'ajouter_modele':
                // Traitement pour ajouter un nouveau modèle
                break;

            case 'ajouter_voiture':
                // Traitement pour ajouter une nouvelle voiture
                break;

            case 'modifier_voiture':
                // Traitement pour modifier une voiture existante
                break;

            case 'supprimer_voiture':
                // Traitement pour supprimer une voiture
                break;
        }
    }
    ?>
</body>
</html>
