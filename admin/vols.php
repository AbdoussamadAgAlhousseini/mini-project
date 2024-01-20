<?php
require_once('dbcon.php');

function displayVols($connexion){
    $sql = 'SELECT ReservationVolID, idclient, DestinationID, DateDepart, DateRetour, NombrePassagers, Statut FROM ReservationsVols';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    // Fetch the results as an associative array
    $vols = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $vols;
}

$vols = displayVols($connexion);

function confirmVols($connexion, $ids)
{
    // Ensure $ids is an array before proceeding
    if (!is_array($ids)) {
        throw new InvalidArgumentException('$ids must be an array');
    }

    // Validate and sanitize $ids to prevent SQL injection
    $sanitizedIds = array_map('intval', $ids);

    try {
        $idsString = implode(',', $sanitizedIds);

        $sql = "UPDATE ReservationsVols SET Statut = 'Confirmée' WHERE ReservationVolID IN ($idsString) AND Statut = 'En Attente'";

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
            confirmVols($connexion, $checkedIds);
            // Assuming displayHotels() handles output, remove extra echo:
            $hotels = displayVols($connexion);
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
    <title>Flights - Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
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
                <h1>Vols manager</h1>
            </header>
            <form method="post" action="">
                         <div class="title">
                            <h2>Liste de vols</h2>
                            <div class="btn"><button type="submit" name="confirmer">Confirmer</button></div>
                         </div>
                <section id="flight-table">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ReservationVolID</th>
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
                        <?php foreach ($vols as $value): ?>
                                        <tr>
                                            <td><?= $value['ReservationVolID']; ?></td>
                                            <td><?= $value['idclient']; ?></td>
                                            <td><?= $value['DestinationID']; ?></td>
                                            <td><?= $value['DateDepart']; ?></td>
                                            <td><?= $value['DateRetour']; ?></td>
                                            <td><?= $value['NombrePassagers']; ?></td>
                                            <td><?= $value['Statut']; ?></td>
                                            <td><input type="checkbox" name="check[]" value="<?= $value['ReservationVolID'] ?>" ></td>
                                        </tr>
                                    <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </form>
            <footer>
                <p>&copy; 2023 ALMA</p>
            </footer>
        </div>
    </div>
</body>

</html>
