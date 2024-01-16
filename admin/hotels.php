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
    if (isset($_POST["confirmer"]) && isset($_POST["check"])) {
        try {
            $idsString = implode(',', $ids);

            $sql = "UPDATE ReservationsHotels SET Statut = 'Confirmée' WHERE ReservationHotelID IN ($idsString)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            echo "Records confirmed successfully!";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmer"]) && isset($_POST["check"])) {
        $checkedIds = $_POST["check"];

        if (!empty($checkedIds)) {
            confirmHotels($connexion, $checkedIds);
            $hotels = displayHotels($connexion);
        } else {
            echo "Veuillez sélectionner au moins un hotel pour être confirmé.";
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

            <!-- Hotel Table Section -->
            <section id="hotel-table">
                
                    <div class="btn">
                        <h2>Liste d'hotels</h2>
                        <button type="submit" name="confirmer">Confirmer</button>
                    </div>
                    <table class="styled-table">
                        <thead>
                            <tr>
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
                
            </section>
            <footer>
                <p>&copy; 2023 ALMA</p>
            </footer>
        </div>
    </div>
</body>

</html>
