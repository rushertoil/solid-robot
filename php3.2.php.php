<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "locauto";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$id_type_de_client = $_POST['id_type_de_client'];
 
$sql = "INSERT INTO Client (nom, prenom, adresse, id_type_de_client)
VALUES ('$nom', '$prenom', '$adresse', '$id_type_de_client')";
 
if ($conn->query($sql) === TRUE) {
    echo "New client added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>