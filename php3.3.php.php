<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles3.3.css">
    <title>Détails du Client</title>
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

    <div class="client">
        <?php
        
        $host = 'localhost';
        $dbname = 'locauto';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_GET['id_client'])) {
                $id_client = $_GET['id_client'];

                $query = "SELECT id_client, nom, prenom, adresse, id_type_de_client FROM Client WHERE id_client = :id_client";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_client', $id_client);
                $stmt->execute();
                $client = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($client) {
                    echo "<h2>Détails du client</h2>";
                    echo "<div class='client-details'>";
                    echo "<table>";
                    echo "<tr><td><strong>Client ID:</strong></td><td>" . htmlspecialchars($client['id_client']) . "</td></tr>";
                    echo "<tr><td><strong>Nom:</strong></td><td>" . htmlspecialchars($client['nom']) . "</td></tr>";
                    echo "<tr><td><strong>Prénom:</strong></td><td>" . htmlspecialchars($client['prenom']) . "</td></tr>";
                    echo "<tr><td><strong>Adresse:</strong></td><td>" . htmlspecialchars($client['adresse']) . "</td></tr>";
                    echo "<tr><td><strong>Type de Client:</strong></td><td>" . htmlspecialchars($client['id_type_de_client']) . "</td></tr>";
                    echo "</table>";
                    echo "</div>";

                    $query_location = "SELECT * FROM Location WHERE id_client = :id_client";
                    $stmt_location = $pdo->prepare($query_location);
                    $stmt_location->bindParam(':id_client', $id_client);
                    $stmt_location->execute();
                    $locations = $stmt_location->fetchAll(PDO::FETCH_ASSOC);

                    if ($locations) {
                        echo "<h2>Historique de location</h2>";
                        echo "<table>";
                        echo "<thead><tr><th>Date de début</th><th>Date de fin</th><th>Voiture</th><th>Immatriculation</th></tr></thead>";
                        echo "<tbody>";
                        foreach ($locations as $location) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($location['date_debut']) . "</td>";
                            echo "<td>" . htmlspecialchars($location['date_fin']) . "</td>";
                            $query_car = "SELECT id_voiture, immatriculation FROM Voiture WHERE id_voiture = :id_voiture";
                            $stmt_car = $pdo->prepare($query_car);
                            $stmt_car->bindParam(':id_voiture', $location['id_voiture']);
                            $stmt_car->execute();
                            $voiture = $stmt_car->fetch(PDO::FETCH_ASSOC);
                            if ($voiture) {
                                echo "<td>" . htmlspecialchars($voiture['id_voiture']) . "</td>";
                                echo "<td>" . htmlspecialchars($voiture['immatriculation']) . "</td>";
                            } else {
                                echo "<td colspan='2'>Voiture non trouvée</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>Aucun historique de location trouvé pour ce client.</p>";
                    }

                    echo "<h2>Ajouter une nouvelle location</h2>";
                    echo "<form method='post' action='ajouter-location.php'>";
                    echo "<input type='hidden' name='id_client' value='" . htmlspecialchars($client['id_client']) . "'>";
                    echo "<label for='id_voiture'>Choisir une voiture :</label>";
                    echo "<select id='id_voiture' name='id_voiture'>";
                    
                    $query_cars = "SELECT id_voiture, immatriculation FROM Voiture";
                    $stmt_cars = $pdo->prepare($query_cars);
                    $stmt_cars->execute();
                    $cars = $stmt_cars->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($cars as $car) {
                        echo "<option value='" . htmlspecialchars($car['id_voiture']) . "'>" . htmlspecialchars($car['immatriculation']) . "</option>";
                    }
                    echo "</select>";
                    echo "<label for='date_debut'>Date de début :</label>";
                    echo "<input type='date' id='date_debut' name='date_debut' required>";
                    echo "<label for='date_fin'>Date de fin :</label>";
                    echo "<input type='date' id='date_fin' name='date_fin' required>";
                    echo "<button type='submit'>Louer la voiture</button>";
                    echo "</form>";
                } else {
                    echo "<p>Aucun client trouvé avec cet ID.</p>";
                }
            } else {
                echo "<p>Aucun ID de client spécifié.</p>";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
