<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'locauto';
$username = 'root';
$password = '';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
 
// Fetch clients
$query = "SELECT id_client, nom, prenom, adresse, id_type_de_client FROM Client";
$stmt = $pdo->prepare($query);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
foreach ($clients as $client) {
    echo "<tr onclick=\"window.location.href='client_history.php?id_client=" . htmlspecialchars($client['id_client']) . "'\">";
    echo "<td>" . htmlspecialchars($client['id_client']) . "</td>";
    echo "<td>" . htmlspecialchars($client['nom']) . "</td>";
    echo "<td>" . htmlspecialchars($client['prenom']) . "</td>";
    echo "<td>" . htmlspecialchars($client['adresse']) . "</td>";
    echo "<td>" . htmlspecialchars($client['id_type_de_client']) . "</td>";
    echo "</tr>";
}
?>