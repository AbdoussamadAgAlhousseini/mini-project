<?php
session_start();

if (!isset($_SESSION["idclient"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["idclient"] ?? "Utilisateur";
$nom_utilisateur = $_SESSION['nom'] ?? "Utilisateur";
$prenom = $_SESSION['prenom'] ?? "";

require_once('connexion.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'] ?? "";
    $date_depart = $_POST['departureDate'] ?? "";
    $date_retour = $_POST['returnDate'] ?? null;
    $nbr_personne = $_POST['adults'] ?? 0;

    $hotel = $_POST['hotel'] ?? ""; // Ajout de cette ligne
    $dateDebut = $_POST['dateDebut'] ?? "";
    $dateFin = $_POST['dateFin'] ?? "";
    $nbrPassagers = $_POST['nbrPassagers'] ?? 0;

    if (strtotime($date_depart) < strtotime($date_retour) || $date_retour === null) {
        $requeteDestinationID = $connexion->prepare("SELECT DestinationID FROM Destinations WHERE NomDestination = ?");
        $requeteDestinationID->execute([$destination]);
        $resultatDestinationID = $requeteDestinationID->fetch();

        if ($resultatDestinationID) {
            $DestinationID = $resultatDestinationID['DestinationID'];

            $requeteInsertion = $connexion->prepare("INSERT INTO ReservationsVols (idclient, DestinationID, DateDepart, DateRetour, NombrePassagers) VALUES (?, ?, ?, ?, ?)");
            $requeteInsertion->execute([$id, $DestinationID, $date_depart, $date_retour, $nbr_personne]);
            $message = "Réservation de vol effectuée avec succès.";
        } else {
            $message = "Cette destination n'existe pas. Veuillez en choisir une autre ou revenir prochainement.";
        }
    } elseif (strtotime($date_depart) >= strtotime($date_retour) && $date_retour !== null) {
        $message = "La date de départ doit être antérieure à la date de retour. Veuillez choisir des dates valides.";
    }

    // Vérifier les réservations d'hôtel seulement si l'utilisateur a fourni des informations d'hôtel
    if (!empty($hotel) && !empty($dateDebut) && !empty($dateFin) && $nbrPassagers > 0) {
        if (strtotime($dateDebut) < strtotime($dateFin) || $dateFin === null) {
            $requeteDestinationID = $connexion->prepare("SELECT DestinationID FROM Destinations WHERE NomDestination = ?");
            $requeteDestinationID->execute([$hotel]);
            $resultatDestinationID = $requeteDestinationID->fetch();

            if ($resultatDestinationID) {
                $DestinationID = $resultatDestinationID['DestinationID'];

                $requeteInsertion = $connexion->prepare("INSERT INTO ReservationsHotels (idclient, DestinationID, DateDebut, DateFin, NombrePersonnes) VALUES (?, ?, ?, ?, ?)");
                $requeteInsertion->execute([$id, $DestinationID, $dateDebut, $dateFin, $nbrPassagers]);
                $message = "Réservation d'hôtel effectuée avec succès.";
            } else {
                $message = "Cette hotel n'existe pas. Veuillez en choisir une autre ou revenir prochainement.";
            }
        } elseif (strtotime($dateDebut) >= strtotime($dateFin) && $dateFin !== null) {
            $message = "La date de début doit être antérieure à la date de fin pour la réservation d'hôtel. Veuillez choisir des dates valides.";
        }
    }
}

// Vous pouvez utiliser la variable $message pour afficher des messages de succès ou d'erreur à l'utilisateur.
?>

<?php
// Paramètres de connexion à la base de données

try {
    // Créer une nouvelle connexion PDO
    $dbh = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');

    // Définir le mode d'erreur sur PDOException
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $commentaire = $_POST['commentaire'];

    // Exécuter la requête SQL d'insertion
    $sql = "INSERT INTO Commentaires (idclient, DestinationID, DateCommentaire, Commentaire)
            VALUES (:idclient, :DestinationID, NOW(), :commentaire)";

    // Remplacez idclient et DestinationID par les valeurs appropriées
    $idclient = $id; // Exemple, remplacez par la valeur réelle
    // $DestinationID = $DestinationID; // Exemple, remplacez par la valeur réelle

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':idclient', $idclient, PDO::PARAM_INT);
    $stmt->bindParam(':DestinationID', $DestinationID, PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

    $stmt->execute();

    // echo "Commentaire ajouté avec succès" . $commentaire;
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout du commentaire : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$dbh = null;
?>


<?php

function getDestinationInfo($destinationId)
{
    global $connexion;

    try {
        $stmt = $connexion->prepare("SELECT NomDestination, Description FROM Destinations WHERE DestinationID = :destinationId");
        $stmt->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result; // Retourne un tableau associatif avec NomDestination et Description
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des informations de la destination : " . $e->getMessage();
        return false;
    }
}

// Exemple d'utilisation
$destinationId = 1; // Remplacez ceci par l'ID réel de votre destination
$destinationInfo = getDestinationInfo($destinationId);

// Vérifiez si des informations ont été récupérées
if ($destinationInfo !== false) {
    $nomDestination = $destinationInfo['NomDestination'];
    $description = $destinationInfo['Description'];
} else {
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

        .reservation-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        /* Style for reservation sections */
        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Style for individual reservation items */
        h6 {
            color: #666;
            font-size: 16px;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        /* Style for reservation details */
        p {
            margin: 5px 0;
        }

        hr {
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        /* Style for no reservation message */
        .no-reservation {
            color: #999;
            font-style: italic;
        }

        .waiting {
            background-color: #ccc;
            color: #000;
            cursor: wait;
        }

        .rating {
            font-size: 24px;
            /* Ajustez la taille des étoiles selon vos besoins */
        }

        .star {
            color: gold;
            /* Couleur des étoiles remplies */
        }

        /* Style pour étoiles non remplies (cinq étoiles vides) */
        .star:empty {
            color: #ddd;
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
            <div class="inutilediv">
                <p>id: <?php echo $message, $date_retour, $datetest . 'je suis la' . strtotime($datetest); ?>


                </p>
            </div>

            <p>id: <?php echo $id; ?></p>

        </div>
    </div>





    <form action="" method="post">

        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">

                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">

                                        <?php


                                        try {

                                            $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');


                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                                            $result = $pdo->query("SELECT NomDestination FROM Destinations");


                                            if ($result) {
                                                echo '<select name="destination" class="custom-select px-4" style="height: 47px;" required>';


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
                                            <input name="departureDate" type="date" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker" required />
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




    <form action="" method="post">

        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">

                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">

                                        <?php


                                        try {

                                            $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');


                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                                            $result = $pdo->query("SELECT NomDestination FROM Destinations");


                                            if ($result) {
                                                echo '<select name="hotel" class="custom-select px-4" style="height: 47px;" required>';


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
                                            <input name="dateDebut" type="date" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date2" data-target-input="nearest">
                                            <input name="dateFin" type="date" class="form-control p-4 datetimepicker-input" placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <input type="number" id="adults" name="nbrPassagers" min="1" class="form-control p-4 datetimepicker-input" required>
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

    // Fonctions de réservation

    function afficherReservationsVols($idClient, $connexion)
    {
        // Requête préparée
        $requeteReservations = $connexion->prepare("SELECT * FROM ReservationsVols WHERE idclient = ?");
        $requeteReservations->execute([$idClient]);

        // Récupération des réservations
        $reservations = $requeteReservations->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des réservations
        if ($reservations) {
            echo "<h2>Vos réservations de vols</h2>";
            foreach ($reservations as $reservation) {
                echo "<h6>Destination</h6>";

                $destinationInfo = getDestinationInfo($reservation['DestinationID']);

                // Vérifiez si des informations ont été récupérées
                if ($destinationInfo !== false) {
                    $nomDestination = $destinationInfo['NomDestination'];
                    $description = $destinationInfo['Description'];

                    // // Utilisez $nomDestination et $description comme nécessaire dans votre code
                    // echo "Nom de la destination : " . $nomDestination . "<br>";
                    // echo "Description : " . $description . "<br>";
                } else {
                    echo "Aucune information de destination trouvée.";
                }


                echo $nomDestination;
                echo "<h6>Date de départ</h6>";
                echo $reservation['DateDepart'];
                echo "<h6>Date de retour</h6>";
                echo $reservation['DateRetour'];
                echo "<h6>Nombre de passagers</h6>";
                echo $reservation['NombrePassagers'];
                echo "<br><a href='supprimeReserveration.php?id=" . $reservation['ReservationVolID'] . "' class='btn btn-danger'>Supprimer cette réservation</a><br><br>";

                // echo ' <button id="btnSupprimerReservation" data-idreservation="123">Supprimer la réservation</button>';
                // echo "<br><a href='supprimerReservation.php?id=" . $reservation["Id"] . "' class='btn btn-danger'>Supprimer cette réservation</a><br><br>";
                echo "<p>Status : </p> <button  class='waiting'>en attente...</button>";

                echo "<hr>";
            }
        } else {
            echo "<p class='no-reservation'>Aucune réservation de vols trouvée.</p>";
            // echo "Aucune réservation de vols trouvée.";
        }
    }

    function afficherReservationsHotels($idClient, $connexion)
    {
        // Requête préparée
        $requeteReservationsHotel = $connexion->prepare("SELECT * FROM ReservationsHotels WHERE idclient = ?");
        $requeteReservationsHotel->execute([$idClient]);

        // Récupération des réservations
        $reservationsHotel = $requeteReservationsHotel->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des réservations
        if ($reservationsHotel) {
            echo "<h2>Vos réservations d'hôtels</h2>";
            foreach ($reservationsHotel as $reservationHotel) {
                echo "<h6>Hôtel</h6>";

                $destinationInfo = getDestinationInfo($reservationHotel['DestinationID']);

                // Vérifiez si des informations ont été récupérées
                if ($destinationInfo !== false) {
                    $nomDestination = $destinationInfo['NomDestination'];
                    $description = $destinationInfo['Description'];

                    // // Utilisez $nomDestination et $description comme nécessaire dans votre code
                    // echo "Nom de la destination : " . $nomDestination . "<br>";
                    // echo "Description : " . $description . "<br>";
                } else {
                    echo "Aucune information de destination trouvée.";
                }

                echo $nomDestination;
                echo "<h6>Date de début</h6>";
                echo $reservationHotel['DateDebut'];
                echo "<h6>Date de fin</h6>";
                echo $reservationHotel['DateFin'];
                echo "<h6>Nombre de personnes</h6>";
                echo $reservationHotel['NombrePersonnes'];
                echo "<br><a href='supprimerReservation.php?id=" . $reservationHotel['ReservationHotelID'] . "' class='btn btn-danger'>Supprimer cette réservation</a><br><br>";
                echo "<p>Status : </p> <button class='btn btn-disabled'>en attente...</button>";
                echo "<hr>";
            }
        } else {
            // echo "Aucune réservation d'hôtel trouvée.";
            echo "<p class='no-reservation'>Aucune réservation de vols trouvée.</p>";
        }
    }

    // Programme principal

    $idClient = $id;
    $connexion = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');

    // Affichage des réservations de vols
    // afficherReservationsVols($idClient, $connexion);

    // // Affichage des réservations d'hôtels
    // afficherReservationsHotels($idClient, $connexion);



    ?>
    <div class="reservation-container">
        <div class="flight-reservations">
            <?php
            // Call afficherReservationsVols function here
            afficherReservationsVols($idClient, $connexion);
            ?>
        </div>

        <div class="hotel-reservations">
            <?php
            // Call afficherReservationsHotels function here
            afficherReservationsHotels($idClient, $connexion);
            ?>
        </div>
    </div>
    <div class="commentaire">
        <h5>Que pensez vous de nos services</h5>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" id="commentaire" name="commentaire" class="form-control" placeholder="Entrez votre commentaire..." required>

            <!-- <button type="button" class="btn btn-primary py-md-3 px-md-5 mt-2 style" onclick="ajouterCommentaire()">Ajouter un commentaire</button> -->
            <button type="submit" class="btn btn-primary py-md-3 px-md-5 mt-2 style">Ajouter un commentaire</button>
        </form>

    </div>

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




        <div class="rating" id="ratingStars">
            <span class="star" onclick="rate(1)">&#9733;</span>
            <span class="star" onclick="rate(2)">&#9733;</span>
            <span class="star" onclick="rate(3)">&#9733;</span>
            <span class="star" onclick="rate(4)">&#9733;</span>
            <span class="star" onclick="rate(5)">&#9733;</span>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            function rate(selectedStar) {
                // Envoie du numéro de l'étoile au script PHP côté serveur
                $.ajax({
                    type: "POST",
                    url: "script.php", // Remplacez script.php par le nom de votre script PHP
                    data: {
                        starNumber: selectedStar
                    },
                    success: function(response) {
                        console.log(response); // Afficher la réponse du serveur (si nécessaire)
                    }
                });
            }
        </script>


        <?php require_once('footer.php'); ?>



        < /body>

            < /html>