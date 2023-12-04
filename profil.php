<?php

session_start();

if (!isset($_SESSION["idclient"])) {
    header("Location: login.php");
    exit();
}

// Récupérer les valeurs de session de manière plus concise
$id = $_SESSION["idclient"] ?? "Utilisateur";
$nom_utilisateur = $_SESSION['nom'] ?? "Utilisateur";
$prenom = $_SESSION['prenom'] ?? "";
$DestinationID = $_SESSION['DestinationID'] ?? "";

// Inclure le fichier de connexion une seule fois
require_once('connexion.php');







// Vérifier si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'] ?? "";
    $date_depart = $_POST['departureDate'] ?? "";
    $date_retour = $_POST['returnDate'] ?? "";
    $nbr_personne = $_POST['adults'] ?? 0;

    // Utiliser des paramètres liés pour éviter l'injection SQL
    $requeteDestinationID = $connexion->prepare("SELECT DestinationID FROM Destinations WHERE NomDestination = ?");
    $requeteDestinationID->execute([$destination]);
    $resultatDestinationID = $requeteDestinationID->fetch();

    if ($resultatDestinationID) {
        $DestinationID = $resultatDestinationID['DestinationID'];

        // Préparer la requête SQL pour l'insertion
        $requeteInsertion = $connexion->prepare("INSERT INTO ReservationsVols (idclient, DestinationID, DateDepart, DateRetour, NombrePassagers) VALUES (?, ?, ?, ?, ?)");

        // Exécuter la requête avec les paramètres
        $requeteInsertion->execute([$id, $DestinationID, $date_depart, $date_retour, $nbr_personne]);
    } else {
        // Gérer le cas où la destination n'existe pas
        echo "Cette destination n'existe pas. Veuillez en choisir une autre ou revenez prochainement.";
    }
}





?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ALMA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .profile-info {
            text-align: center;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }
    </style>
</head>

<body>
    <?php require_once('header.php'); ?>

    <div class="container">
        <div class="profile-info">
            <img src="dv.svg" alt="Photo de profil" class="profile-picture">
            <h1>Bienvenue, <?php echo $prenom . ' ' . $nom; ?>!</h1>
            <a href="deconnexion.php">Se déconnecter</a>

            <p>DestinationID: <?php
                                echo $DestinationID;
                                ?></p>
            <p>id: <?php echo $id; ?></p>

        </div>
    </div>

    <!-- 
    <form id="flightSearchForm" action="" method="post">
        <label for="origin">Origin:</label>
        <input type="text" id="origin" name="origin" required>

        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required>

        <label for="departureDate">Departure Date:</label>
        <input type="date" id="departureDate" name="departureDate" required>

        <label for="returnDate">Return Date:</label>
        <input type="date" id="returnDate" name="returnDate" required>

        <label for="adults">Number of Adults:</label>
        <input type="number" id="adults" name="adults" min="1" required>

        <button type="submit">Search Flights</button>
    </form> -->


    <form action="" method="post">

        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">

                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <!-- <select name="destination" class="custom-select px-4" style="height: 47px;">
                                            <option selected>Destination</option>
                                            <option value="1">Destination 1</option>
                                            <option value="2">Destination 2</option>
                                            <option value="3">Destination 3</option>
                                        </select> -->

                                        <?php


                                        try {

                                            $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');


                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                                            $result = $pdo->query("SELECT NomDestination FROM Destinations");


                                            if ($result) {
                                                echo '<select name="destination" class="custom-select px-4" style="height: 47px;">';


                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['NomDestination'] . '">' . $row['NomDestination'] . '</option>';
                                                }

                                                echo '</select>';
                                            } else {
                                                echo 'Aucun résultat trouvé.';
                                            }
                                        } catch (PDOException $e) {
                                            echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input name="departureDate" type="date" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date2" data-target-input="nearest">
                                            <input name="returnDate" type="date" class="form-control p-4 datetimepicker-input" placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <input type="number" id="adults" name="adults" min="1" class="form-control p-4 datetimepicker-input" required>
                                    </div>
                                </div>
                                <!-- <button type="submit">Envoyer</button> -->

                            </div>

                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    //  echo $destination . "<br>" . $date_depart . "<br>" . $date_retour . "<br>" . $nbr_personne . "<br>" ;


    $requeteReservations = $connexion->prepare("SELECT * FROM ReservationsVols WHERE idclient = ?");
    $requeteReservations->execute([$id]);
    $reservations = $requeteReservations->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les réservations
    if ($reservations) {
        foreach ($reservations as $reservation) {
            echo "Destination: " . $reservation['DestinationID'] . "<br>";
            echo "Date de départ: " . $reservation['DateDepart'] . "<br>";
            echo "Date de retour: " . $reservation['DateRetour'] . "<br>";
            echo "Nombre de passagers: " . $reservation['NombrePassagers'] . "<br>";
            echo "-------------------------<br>";
        }
    } else {
        echo "Aucune réservation trouvée.";
    }


    ?>

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h6>

            </div>
            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-ticket-alt mx-auto mb-4"></i>
                        <h5 class="mb-2">Ticket Booking</h5>
                        <p class="m-0">Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est
                            amet labore</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-hotel mx-auto mb-4"></i>
                        <h5 class="mb-2">Hotel Booking</h5>
                        <p class="m-0">Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est
                            amet labore</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        <?php


        // try {

        //     $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');


        //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        //     $result = $pdo->query("SELECT NomDestination FROM Destinations");


        //     if ($result) {
        //         echo '<select name="destination">';


        //         while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //             echo '<option value="' . $row['NomDestination'] . '">' . $row['NomDestination'] . '</option>';
        //         }

        //         echo '</select>';
        //     } else {
        //         echo 'Aucun résultat trouvé.';
        //     }
        // } catch (PDOException $e) {
        //     echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
        // }
        ?> -->


        <?php require_once('footer.php'); ?>



</body>

</html>