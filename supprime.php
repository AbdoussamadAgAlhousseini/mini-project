
<?php
require_once('connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $idReservation = filter_var($_GET['id'], FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));

    if ($idReservation === false) {

        header("Location: page_erreur.php");
        exit();
    }


    $requeteSuppression = $connexion->prepare("DELETE FROM ReservationsHotels WHERE ReservationHotelID = :id");
    $requeteSuppression->bindParam(':id', $idReservation, PDO::PARAM_INT);

    try {
        $requeteSuppression->execute();


        header("Location: profil.php");
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression
        header("Location: page_erreur.php");
        exit();
    }
} else {

    header("Location: page_erreur.php");
    exit();
}
