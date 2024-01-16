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

?>

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
            <footer>
                <p>&copy; 2023 ALMA</p>
            </footer>
        </div>
    </div>
</body>

</html>
