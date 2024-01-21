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
                        <a href="index.php" class="nav-item nav-link active">Accueil</a>
                        <a href="about.php" class="nav-item nav-link">A propos</a>
                        <a href="service.php" class="nav-item nav-link">Services</a>

                        <a href="contact.php" class="nav-item nav-link">Contact</a>

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
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Voyages</h4>
                            <h1 class="display-3 text-white mb-md-4">Découvrez Le Monde Avec nous</h1>
                            <a href="reservation.php" class="btn btn-primary py-md-3 px-md-5 mt-2">

                                Reservez Maintenant
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Voyages</h4>
                            <h1 class="display-3 text-white mb-md-4">Les Endroits Incroyablements Beaux</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserver Maintenant</a>
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
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">A Propos de Nous</h6>
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
                        <a href="" class="btn btn-primary mt-1">Reservez</a>
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
                            <h5 class="">Des prix competitives </h5>
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
                            <h5 class="">Les Meilleurs Services</h5>
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
                            <h5 class="">Nous Couvrons Les Meilleures Destinations</h5>
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
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destinations</h6>
                <h1>Explorez Le Top Destination</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/mec.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">La Mecque</h5>
                            <span>10000 DA</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-2.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">France</h5>
                            <span>1000 DA</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-3.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Australie</h5>
                            <span>1000</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/inde.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Inde</h5>
                            <span>1000</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/destination-5.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Afrique du sud</h5>
                            <span>1000</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid taille" src="img/indonesie.jpg" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">Indonesie</h5>
                            <span>1000</span>
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
                <h1>Tours & Voyages Services</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-route mx-auto mb-4"></i>
                        <h5 class="mb-2">Guide de voyage</h5>
                        <p class="m-0">Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est
                            amet labore</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <a href="profil.php">
                            <i class="fa fa-2x fa-ticket-alt mx-auto mb-4"></i>

                            <h5 class="mb-2">Reservez un vol</h5>
                        </a>
                        <p class="m-0">Justo sit justo eos amet tempor amet clita amet ipsum eos elitr. Amet lorem est
                            amet labore</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <a href="profil.php">
                            <i class="fa fa-2x fa-hotel mx-auto mb-4"></i>
                            <h5 class="mb-2">Reservez un Hotel</h5>
                        </a>
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
            echo '                    <img class="img-fluid" src="' . $destination['Image'] . '" alt="">';
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


            if ($ratingGiven) {
                break;
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
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Mega Offre</h6>
                        <h1 class="text-white"><span class="text-primary">-30%</span> Pour les lune de miel</h1>
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
                <h1>Nos Guides</h1>
            </div>
            <div class="row equipe">
                <div class="col-lg-3 col-md-2 col-sm-3 pb-2">
                    <div class="team-item bg-white mb-2">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
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
                            <h5 class="text-truncate">Remy</h5>
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
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Temoignage</h6>
                <h1>Que Dit Notre clientèle</h1>
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
                        echo '        <p class="mt-5">' . $row['DestinationID'] . '</p>';
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


                $dbh = null;
                ?>


            </div>

        </div>

    </div>




    <!-- Footer Start -->
    <?php require_once('footer.php') ?>

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
                    destinationId: <?php echo $destinationId; ?>
                },
                success: function(response) {
                    alert('vous avez noter la destination')

                }
            });
        }
    </script>

</body>

</html>





</body>

</html>