<?php
require_once('dbcon.php');

function displayHotels($connexion){
    $sql = 'SELECT ReservationHotelID, idclient, DestinationID, DateDebut, DateFin, NombrePersonnes, Statut FROM ReservationsHotels';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    // Fetch the results as an associative array
    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $hotels;
}

$hotels = displayHotels($connexion);

function confirmHotels($connexion, $ids)
{
    // Ensure $ids is an array before proceeding
    if (!is_array($ids)) {
        throw new InvalidArgumentException('$ids must be an array');
    }

    // Validate and sanitize $ids to prevent SQL injection
    $sanitizedIds = array_map('intval', $ids);

    try {
        $idsString = implode(',', $sanitizedIds);

        $sql = "UPDATE ReservationsHotels SET Statut = 'Confirmée' WHERE ReservationHotelID IN ($idsString) AND Statut = 'En Attente'";

        $stmt = $connexion->prepare($sql);
        $stmt->execute();

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Use echo for consistent output
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmer"]) && isset($_POST["check"])) {
        $checkedIds = $_POST["check"];

        if (!empty($checkedIds)) {
            confirmHotels($connexion, $checkedIds);
            // Assuming displayHotels() handles output, remove extra echo:
            $hotels = displayHotels($connexion);
        } else {
            echo "Veuillez sélectionner au moins un hôtel pour être confirmé.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels - Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <a href="dashboard.html">
                <h2>ALMA</h2>
            </a>
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

<<<<<<< HEAD
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
                            <th>Confirmer la reservation</th>
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
                                    $sql = "UPDATE ReservationsHotels SET Statut = 'confirmée' WHERE idclient = :idclient";
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
=======
            <!-- Hotel Table Section -->
            <section id="hotel-table">
                
                   
                    <form method="post" action="">
                         <div class="title">
                            <h2>Liste d'hotels</h2>
                            <div class="btn"><button type="submit" name="confirmer">Confirmer</button></div>
                         </div>
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>IDreservation</th>
                                    <th>IDclient</th>
                                    <th>DestinationID</th>
                                    <th>DateDebut</th>
                                    <th>DateFin</th>
                                    <th>NombrePersonnes</th>
                                    <th>Statut</th>
                                    <th>Confirmer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hotels as $value): ?>
                                    <tr>
                                        <td><?= $value['ReservationHotelID']; ?></td>
                                        <td><?= $value['idclient']; ?></td>
                                        <td><?= $value['DestinationID']; ?></td>
                                        <td><?= $value['DateDebut']; ?></td>
                                        <td><?= $value['DateFin']; ?></td>
                                        <td><?= $value['NombrePersonnes']; ?></td>
                                        <td><?= $value['Statut']; ?></td>
                                        <td><input type="checkbox" name="check[]" value="<?= $value['ReservationHotelID'] ?>" ></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                
>>>>>>> f6218c431d57f7df2fcdd127a081516b19516cdb
            </section>
            <footer>
                <p>&copy; 2023 ALMA</p>
            </footer>
        </div>
    </div>
</body>

</html>