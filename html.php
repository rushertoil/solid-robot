<?php 
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Récupérer toutes les voitures de la base de données
$sql = "SELECT * FROM modele";
$result = $connexion->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentACar</title>
    <link rel="stylesheet" href="styles.css">
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
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher une voiture...">
        <button onclick="searchCars()">🔍</button>
    </div>
    <div class="video-background">
        <video autoplay muted loop>
            <source src="cars.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="cars">
        <?php
        if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='car'>";
                echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['libelle']) . "'>";
                echo "<h2>" . htmlspecialchars($row['libelle']) . "</h2>";
                echo "</div>";

            }
        } else {
            echo "Aucune voiture disponible.";
        }
        ?>
    </div>

    <script>
        function searchCars() {
            var input, filter, cars, car, title, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            cars = document.getElementsByClassName("car");
            for (i = 0; i < cars.length; i++) {
                car = cars[i];
                title = car.getElementsByTagName("h2")[0];
                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                    car.style.display = "";
                } else {
                    car.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>

<?php $connexion = null; ?>
