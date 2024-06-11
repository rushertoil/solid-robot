<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles3.css">
    <title>Gestion des Clients</title>
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

    <div class="search-container">
        <label for="clientSearch">Rechercher Client :</label>
        <input type="text" id="clientSearch" onkeyup="searchClient()">
        <button onclick="addClient()">Ajouter Client</button>
    </div>
    
    <table id="clientTable">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Type de Client</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'php3-1.php'; ?>
        </tbody>
    </table>

    <script>
        function searchClient() {
            const input = document.getElementById('clientSearch').value.toLowerCase();
            const table = document.getElementById('clientTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                const td = tr[i].getElementsByTagName('td');
                for (let j = 0; j < td.length; j++) {
                    if (td[j] && td[j].innerHTML.toLowerCase().indexOf(input) > -1) {
                        tr[i].style.display = '';
                        break;
                    }
                }
            }
        }

        function addClient() {
            window.location.href = 'html3.html';
        }
    </script>
</body>
</html>
