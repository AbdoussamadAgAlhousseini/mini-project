<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights - Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <a href="dashboard.html"><h2>ALMA</h2></a>
            <a href="dashboard.html">Dashboard</a>
            <a href="admin.php">Admin</a>
            <a href="booking.php">Bookings</a>
            <a href="vols.php">Flights</a>
            <a href="hotels.php">Hotels</a>
    </div>
        <div class="content">
            <header>
                <h1>Flights Management</h1>
            </header>

            <!-- Flight Table Section -->
            <section id="flight-table">
                <h2>Flight List</h2>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>IDclient</th>
                            <th>DestinationID</th>
                            <th>Date depart</th>
                            <th>Date retour</th>
                            <th>nombre passagers</th>
                            <th>statut</th>
                            <th>Changer statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            // Connexion à la base de données
                            $serveur = "localhost";
                            $utilisateur = "root";
                            $motDePass = "root";
                            $baseDeDonnees = "projet";

                            $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePass);

                            // Requête SQL pour sélectionner des colonnes spécifiques de la table
                            $sql = "SELECT `idclient`, `DestinationID`, `DateDepart`, `DateRetour`, `NombrePassagers`, `Statut` FROM `ReservationsVols` 
                                    WHERE Statut = 'En Attente'";
                            $stmt = $connexion->query($sql);

                            // Vérification des résultats
                            if ($stmt->rowCount() > 0) {
                                // Affichage des données dans le tableau
                                
                                // Affichage des données dans le tableau
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>" . $row["idclient"] . "</td>
                                        <td>" . $row["DestinationID"] . "</td>
                                        <td>" . $row["DateDepart"] . "</td>
                                        <td>" . $row["DateRetour"] . "</td>
                                        <td>" . $row["NombrePassagers"] . "</td>
                                        <td>" . $row["Statut"] . "</td>
                                        <td><buttononclick=\"modifierStatut('" . $row["idclient"] . "')\">Modifier Statut</button></td>
                                    </tr>";
                            }

                            } else {
                                echo "<tr><td colspan='6'>Aucun résultat trouvé.</td></tr>";
                            }

                            
                        } catch (PDOException $e) {
                            echo "Erreur de connexion à la base de données : " . $e->getMessage();
                        } finally {
                            $connexion = null;
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <footer>
                <p>&copy; 2023 ALMA</p>
            </footer>
        </div>
    </div>
</body>
</html>
