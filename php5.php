<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "
    SELECT location.date_debut, location.date_fin, modele.libelle AS modele, voiture.immatriculation, modele.image
    FROM location
    JOIN voiture ON location.id_voiture = voiture.id_voiture
    JOIN modele ON voiture.id_modele = modele.id_modele";

    $result = $connexion->query($sql);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voitures Louées</title>
    <link rel="stylesheet" href="styles5.css">
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
    <div class="container">
        <h1>Voitures Louées</h1>
        <table>
            <tr>
                <th>Modèle</th>
                <th>Immatriculation</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Photo</th>
            </tr>
            <?php
            if ($result->rowCount() > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["modele"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["immatriculation"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date_debut"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date_fin"]) . "</td>";
                    echo "<td><img src='images/" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["modele"]) . "'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune voiture louée trouvée</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
