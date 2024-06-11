<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Voitures</title>
    <link rel="stylesheet" type="text/css" href="styles4.css">
</head>
<body>
<header>
        <div class="logo">
            <img src="image.png" alt="Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="php1.php">Accueil</a></li>
                <li><a href="php2.php">Stock de véhicule</a></li>
                <li><a href="php4.php">Ajouter véhicule</a></li>
                <li><a href="php3.php">Ajouter client</a></li>
                <li><a href="php5.php">Historique</a></li>
            </ul>
        </nav>
    </header>
        <div class="container">
            <h1>Gestion des Voitures</h1>
        </div>
    </header>
    <div class="container main">

    <?php
    try {
        $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<div class='message error'>Erreur de connexion : " . $e->getMessage() . "</div>";
        exit();
    }


    $stmt = $connexion->query("SELECT id_modele, libelle FROM modele");
    $modeles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $connexion->query("SELECT id_categorie, libelle FROM categorie");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $connexion->query("SELECT id_marque, libelle FROM marque");
    $marques = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['add_model'])) {
        $libelle = $_POST['libelle'];
        $id_categorie = $_POST['id_categorie'];
        $id_marque = $_POST['id_marque'];
        $image = $_POST['image'];
        $id_modele = $_POST['id_modele'];

        $sql = "INSERT INTO modele (id_modele, libelle, id_categorie, id_marque, image) VALUES (:id_modele, :libelle, :id_categorie, :id_marque, :image)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_modele', $id_modele);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':id_marque', $id_marque);
        $stmt->bindParam(':image', $image);
        


        if ($stmt->execute()) {
            echo "<div class='message success'>Nouveau modèle ajouté avec succès</div>";
            $stmt = $connexion->query("SELECT id_modele, libelle FROM modele");
            $modeles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "<div class='message error'>Erreur lors de l'ajout du modèle</div>";
        }
    }

    if (isset($_POST['add'])) {
        $immatriculation = $_POST['immatriculation'];
        $compteur = $_POST['compteur'];
        $id_modele = $_POST['id_modele'];

        $sql = "INSERT INTO voiture (immatriculation, compteur, id_modele) VALUES (:immatriculation, :compteur, :id_modele)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':immatriculation', $immatriculation);
        $stmt->bindParam(':compteur', $compteur);
        $stmt->bindParam(':id_modele', $id_modele);

        if ($stmt->execute()) {
            echo "<div class='message success'>Nouvelle voiture ajoutée avec succès</div>";
        } else {
            echo "<div class='message error'>Erreur lors de l'ajout de la voiture</div>";
        }
    }

    if (isset($_POST['edit'])) {
        $id_voiture = $_POST['id_voiture'];
        $immatriculation = $_POST['immatriculation'];
        $compteur = $_POST['compteur'];
        $id_modele = $_POST['id_modele'];
        

        $sql = "UPDATE voiture SET immatriculation = :immatriculation, compteur = :compteur, id_modele = :id_modele WHERE id_voiture = :id_voiture";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_voiture', $id_voiture);
        $stmt->bindParam(':immatriculation', $immatriculation);
        $stmt->bindParam(':compteur', $compteur);
        $stmt->bindParam(':id_modele', $id_modele);

        if ($stmt->execute()) {
            echo "<div class='message success'>Voiture mise à jour avec succès</div>";
        } else {
            echo "<div class='message error'>Erreur lors de la mise à jour de la voiture</div>";
        }
    }

    if (isset($_POST['delete'])) {
        $id_voiture = $_POST['id_voiture'];

        $sql = "DELETE FROM voiture WHERE id_voiture = :id_voiture";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_voiture', $id_voiture);

        if ($stmt->execute()) {
            echo "<div class='message success'>Voiture supprimée avec succès</div>";
        } else {
            echo "<div class='message error'>Erreur lors de la suppression de la voiture</div>";
        }
    }
    ?>

    <h2>Ajouter un nouveau modèle</h2>
    <form method="post">
        <label>Libellé:</label><br>
        <input type="text" name="libelle" required><br>
        <label>Catégorie:</label><br>
        <select name="id_categorie" required>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Marque:</label><br>
        <select name="id_marque" required>
            <?php foreach ($marques as $marque) : ?>
                <option value="<?= $marque['id_marque'] ?>"><?= $marque['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Image:</label><br>
        <input type="text" name="image" required><br><br>
        <label for="id_modele">ID Modèle :</label>
        <input type="number" id="id_modele" name="id_modele" required>
        <input type="submit" name="add_model" value="Ajouter Modèle">
    </form>

    <h2>Ajouter une nouvelle voiture</h2>
    <form method="post">
        <label>Immatriculation:</label><br>
        <input type="text" name="immatriculation" required><br>
        <label>Compteur:</label><br>
        <input type="number" name="compteur" required><br>
        <label>Modèle:</label><br>
        <select name="id_modele" required>
            <?php foreach ($modeles as $modele) : ?>
                <option value="<?= $modele['id_modele'] ?>"><?= $modele['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" name="add" value="Ajouter">
    </form>

    <h2>Modifier une voiture existante</h2>
    <form method="post">
        <label>ID Voiture:</label><br>
        <input type="number" name="id_voiture" required><br>
        <label>Immatriculation:</label><br>
        <input type="text" name="immatriculation" required><br>
        <label>Compteur:</label><br>
        <input type="number" name="compteur" required><br>
        <label>Modèle:</label><br>
        <select name="id_modele" required>
            <?php foreach ($modeles as $modele) : ?>
                <option value="<?= $modele['id_modele'] ?>"><?= $modele['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" name="edit" value="Modifier">
    </form>

    <h2>Supprimer une voiture existante</h2>
    <form method="post">
        <label>ID Voiture:</label><br>
        <input type="number" name="id_voiture" required><br><br>
        <input type="submit" name="delete" value="Supprimer">
    </form>
    </div>
</body>
</html>
