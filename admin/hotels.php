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
                <h1>Hotels Management</h1>
            </header>

            <!-- Flight Table Section -->
            <section id="flight-table">
                <h2>Liste d'hotels</h2>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>IDclient</th>
                            <th>DestinationID</th>
                            <th>DateDebut</th>
                            <th>DateFin</th>
                            <th>N˚ personnes</th>
                            <th>statut</th>
                            <th>Changer statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $serveur = "localhost";
                            $utilisateur = "root";
                            $motDePass = "root";
                            $baseDeDonnees = "projet";

                            $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePass);
                            $sql = "SELECT `idclient`, `DestinationID`, `DateDebut`, `DateFin`, `NombrePersonnes`, `Statut` FROM `ReservationsHotels` 
                                    WHERE Statut = 'En Attente'";
                            $stmt = $connexion->query($sql);

                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                            <td>" . $row["idclient"] . "</td>
                                            <td>" . $row["DestinationID"] . "</td>
                                            <td>" . $row["DateDebut"] . "</td>
                                            <td>" . $row["DateFin"] . "</td>
                                            <td>" . $row["NombrePersonnes"] . "</td>
                                            <td>" . $row["Statut"] . "</td>
                                            <td> 
                                                <form method='post' action='' style='width: 150px;'>
                                                    <input type='hidden' name='idclient' value='" . $row["idclient"] . "'>
                                                    <input type='submit' value='Modifier Statut' name='submit'>
                                                </form>
                                            </td>
                                          </tr>";
                                }

                                if (isset($_POST["submit"])) {
                                    $idclient = $_POST["idclient"];
                                    $sql = "UPDATE ReservationsHotels SET Statut = 'confirme' WHERE idclient = :idclient";
                                    $stmt = $connexion->prepare($sql);
                                    $stmt->bindParam(':idclient', $idclient);
                                    $stmt->execute();

                                    echo "Le statut a été mis à jour avec succès.";
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
