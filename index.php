<?php
session_start();
require_once("connexion.php");
// $_SESSION['destinationId'];
// $_SESSION['destinationId'];
$_SESSION['nomDestination'];
function getDestinationInfo($destinationId)
{
    global $connexion;

    try {
        $stmt = $connexion->prepare("SELECT NomDestination, Description FROM Destinations WHERE DestinationID = :destinationId");
        $stmt->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des informations de la destination : " . $e->getMessage();
        return false;
    }
}


$destinationId = 1;
$destinationInfo = getDestinationInfo($destinationId);


if ($destinationInfo !== false) {
    $nomDestination = $destinationInfo['NomDestination'];
    $description = $destinationInfo['Description'];
}
?>







<!DOCTYPE html>
<html lang="fr">

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
        .taille {
            width: 500px;
            height: 200px;
        }

        .equipe {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .espace {
            padding-top: 3.6rem;

        }

        .style {
            display: flex;
            align-items: center;
        }

        .rating {
            font-size: 24px;
            cursor: pointer;
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

    <script>
        function ajouterCommentaire() {

            // Récupération des valeurs du formulaire
            var idclient = document.getElementById("idclient").value;
            var destinationID = document.getElementById("destinationID").value;
            var commentaire = document.getElementById("commentaire").value;
            $idclient = 1;

            // Appel de la fonction d'ajout de commentaire
            var nbCommentairesInseres = ajouterCommentaire(connexion, idclient, destinationID, commentaire);

            if (nbCommentairesInseres > 0) {
                // Message de succès
                alert("Commentaire inséré avec succès !");
            } else {
                // Message d'erreur
                alert("Une erreur s'est produite lors de l'insertion du commentaire.");
            }
            alert(commentaire);

        }
    </script>

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i><a href="mailto:abdoussamad1952@gmail.com?subject=Réservation&body=">abdoussamad1952@gmail.com</a>
                        </p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+213771836015</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="https://www.facebook.com/NOMDEVOTREPAG/facebook.com/messages/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="https://wa.me/+22391427701?text=Bonjour">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->




    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0 test">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">AL</span>MA</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Accueil</a>
                        <a href="about.html" class="nav-item nav-link">A propos</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>

                        <a href="contact.html" class="nav-item nav-link">Contact</a>

                        <a href="login.php" class="nav-item nav-link"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg></a>

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Let's Discover The World Together</h1>
                            <a href="reservation.php" class="btn btn-primary py-md-3 px-md-5 mt-2">

                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/tourist.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
                        <h1 class="mb-3">We Provide Best Tour Packages In Your Budget</h1>
                        <p>Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore
                            sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et
                            erat sed diam duo</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-2.jpg" alt="">
                            </div>
                        </div>
                        <a href="" class="btn btn-primary mt-1">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5 espace">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Competitive Pricing</h5>
                            <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Best Services</h5>
                            <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Worldwide Coverage</h5>
                            <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                <h1>Explore Top Destination</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/new york.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">United States</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-2.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">United Kingdom</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-3.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Australia</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/inde.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">India</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-5.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">South Africa</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/indonesie.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Indonesia</h5>
                            <span>100 Cities</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination Start -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h6>
                <h1>Tours & Travel Services</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-route mx-auto mb-4"></i>
                        <h5 class="mb-2">Travel Guide</h5>
                        <p class="m-0">Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est
                            amet labore</p>
                    </div>
                </div>
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
    </div>


    <?php

    function getAllDestinations()
    {
        global $connexion;

        try {
            $stmt = $connexion->prepare("SELECT * FROM Destinations");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de toutes les destinations : " . $e->getMessage();
            return false;
        }
    }


    function getAverageRatingForPackage($packageId)
    {
        global $connexion;

        try {
            $stmt = $connexion->prepare("SELECT AVG(Note) AS averageRating FROM Notations WHERE DestinationID = :packageId");
            $stmt->bindParam(':packageId', $packageId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['averageRating'] ?: 0;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la note moyenne : " . $e->getMessage();
        }
    }

    function getNumberOfRatingsForPackage($packageId)
    {
        global $connexion;

        try {
            $stmt = $connexion->prepare("SELECT COUNT(*) AS numberOfRatings FROM Notations WHERE DestinationID = :packageId");
            $stmt->bindParam(':packageId', $packageId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['numberOfRatings'] ?: 0;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du nombre de notations : " . $e->getMessage();
        }
    }


    $destinations = getAllDestinations();
    $_SESSION['destinationIds'] = array();

    if ($destinations !== false) {
        echo '<div class="container-fluid py-5">';
        echo '    <div class="container pt-5 pb-3">';
        echo '        <div class="text-center mb-3 pb-3">';
        echo '            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>';
        echo '            <h1>Pefect Tour Packages</h1>';
        echo '        </div>';
        echo '        <div class="row">';

        $ratingGiven = false;

        foreach ($destinations as $destination) {
            $destinationId = $destination['DestinationID'];
            $nomDestination = $destination['NomDestination'];
            $description = $destination['Description'];
            $prix = $destination['Prix'];
            $_SESSION['destinationIds'][] = $destinationId;

            echo '            <div class="col-lg-4 col-md-6 mb-4">';
            echo '                <div class="package-item bg-white mb-2">';
            echo '                    <img class="img-fluid" src="' . $destination['Image'] . '" alt="">'; // Assurez-vous d'ajuster le chemin de l'image
            echo '                    <div class="p-4">';
            echo '                        <div class="d-flex justify-content-between mb-3">';
            echo '                            <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>' . $nomDestination . '</small>';

            echo '<div class="rating" data-destination-id="' . $destinationId . '">';
            echo '<span class="star" onclick="rate(1, ' . $destinationId . ')">&#9733;</span>';
            echo '<span class="star" onclick="rate(2, ' . $destinationId . ')">&#9733;</span>';
            echo '<span class="star" onclick="rate(3, ' . $destinationId . ')">&#9733;</span>';
            echo '<span class="star" onclick="rate(4, ' . $destinationId . ')">&#9733;</span>';
            echo '<span class="star" onclick="rate(5, ' . $destinationId . ')">&#9733;</span>';
            echo '</div>';

            echo '                        </div>';
            echo '                        <a class="h5 text-decoration-none" href="">' . $description . '</a>';
            echo '                        <div class="border-top mt-4 pt-4">';
            echo '                            <div class="d-flex justify-content-between">';
            echo '                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>';
            echo '                                    ' . number_format(getAverageRatingForPackage($destinationId), 1);
            echo '                                    <small>(' . getNumberOfRatingsForPackage($destinationId) . ')</small>';
            echo '                                </h6>';
            echo '                                <h5 class="m-0">$' . $prix . '</h5>';
            echo '                            </div>';
            echo '                        </div>';
            echo '                    </div>';
            echo '                </div>';
            echo '            </div>';

            // Vérifier si une note a été attribuée
            if ($ratingGiven) {
                break; // Sortir de la boucle
            }
        }

        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    } else {
        echo "Aucune destination trouvée.";
    }
    ?>





    <!-- Packages End -->


    <!-- Registration Start -->
    <div class="container-fluid bg-registration py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Mega Offer</h6>
                        <h1 class="text-white"><span class="text-primary">30% OFF</span> For Honeymoon</h1>
                    </div>
                    <p class="text-white">Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem
                        ipsum ut sed eos,
                        ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
                        dolor</p>
                    <ul class="list-inline text-white m-0">
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Labore eos amet dolor amet diam
                        </li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Etsea et sit dolor amet ipsum</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Diam dolor diam elitripsum vero.
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5">

                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->


    <!-- Team Start -->
    <div class="container-fluid py-5 ">
        <div class="container pt-5 pb-3 ">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Guides</h6>
                <h1>Our Travel Guides</h1>
            </div>
            <div class="row equipe">
                <div class="col-lg-3 col-md-2 col-sm-3 pb-2">
                    <div class="team-item bg-white mb-2">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-2">
                            <h5 class="text-truncate">Abdoussamad</h5>
                            <p class="m-0">Designation</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-2 col-sm-3 pb-2">
                    <div class="team-item bg-white mb-2">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-4.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>

                            </div>
                        </div>
                        <div class="text-center py-2">
                            <h5 class="text-truncate">Benzoukout</h5>
                            <p class="m-0">Designation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h6>
                <h1>What Say Our Clients</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <?php



                try {

                    $dbh = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');


                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sql = "SELECT Commentaires.Commentaire, Commentaires.DateCommentaire, Clients.Nom
            FROM Commentaires
            LEFT JOIN Clients ON Commentaires.idclient = Clients.idclient
            ORDER BY Commentaires.DateCommentaire DESC
            LIMIT 10";

                    $stmt = $dbh->query($sql);


                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


                        echo '<div class="text-center">';
                        echo '    <img class="img-fluid mx-auto" src="img/testimonial-4.jpg" style="width: 100px; height: 100px;">';
                        echo '    <div class="testimonial-text bg-white p-4 mt-n5">';
                        echo '        <p class="mt-5">' . $row['Commentaire'] . '</p>';

                        echo '        <p class="mt-5">' . $_SESSION['nomDestination']  . '</p>';
                        echo '        <h5 class="text-truncate">' . $row['Nom'] . '</h5>';
                        echo '        <span>' . $row['DateCommentaire'] . '</span>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    echo "Erreur lors de la récupération des commentaires : " . $e->getMessage();
                }

                // Fermer la connexion à la base de données
                $dbh = null;
                ?>


            </div>

        </div>

    </div>




    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">AL</span>MA</h1>
                </a>
                <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed
                    vero lorem dolor dolor</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                <div class="d-flex justify-content-start">

                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/NOMDEVOTREPAG/facebook.com/messages/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="https://wa.me/+22391427701?text=Bonjour"><i class="fab fa-whatsapp"></i></a>





                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Nos Services</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>A propos</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destinations</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Témoignages</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Informations utiles</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contactez-nous</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>ouled fayet plateau</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+213771836015</p>
                <p><i class="fa fa-envelope mr-2"></i>abdoussamad1952@gmail.com</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Mini-project</a>. All Rights Reserved.</a>
                </p>
            </div>

        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <script>
        function rate(selectedStar, destinationId) {

            $.ajax({
                type: "POST",
                url: "script.php",
                data: {
                    starNumber: selectedStar,
                    destinationId: <?php $destinationId ?>

                },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script> -->

    <script>
        function rate(selectedStar, destinationId) {
            $.ajax({
                type: "POST",
                url: "script.php",
                data: {
                    starNumber: selectedStar,
                    destinationId: <?php echo $destinationId; ?> // Correction ici
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>

</body>

</html>





</body>

</html>