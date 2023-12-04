<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['idclient'])) {
    header("Location: profil.php"); // Rediriger vers la page d'accueil
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de connexion à la base de données
    // require_once('connexion.php');



    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "root"; // Mot de passe MySQL
    $baseDeDonnees = "projet"; // Nom de la base de données

    try {
        // Créer une connexion PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);

        // Définir le mode d'erreur PDO à exception
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connexion réussie";

        // Vous pouvez maintenant exécuter des requêtes SQL ici
    } catch (PDOException $e) {
        die("Échec de la connexion : " . $e->getMessage());
    }

    // Fermer la connexion
    // $connexion = null;

    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Préparer la requête SQL (assurez-vous d'ajuster la structure de votre table)
    $requete = $connexion->prepare("SELECT * FROM Clients WHERE email = ?");

    // Exécuter la requête avec le paramètre
    $requete->execute([$email]);

    // Récupérer le résultat de la requête
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et le mot de passe est correct
    if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
        // Enregistrez l'ID de l'utilisateur dans la session
        $_SESSION['idclient'] = $utilisateur['idclient'];
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['email'] = $utilisateur['email'];
        $_SESSION['prenom'] = $utilisateur['prenom'];

        // Rediriger vers la page d'accueil
        header("Location: profil.php");
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
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
        .style {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5%;

        }

        .form {
            box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.5);

        }
    </style>
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
                        <a class="text-primary px-3" href="https://www.facebook.com/Abdoussamad/facebook.com/messages/">
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
    <div class="container-fluid position-relative nav-bar p-0">
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
                        <!-- <a href="about.html" class="nav-item nav-link">A propos</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="login.html" class="nav-item nav-link">Login</a> -->
                        <!-- <a href="package.html" class="nav-item nav-link">Tour Packages</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="blog.html" class="dropdown-item">Blog Grid</a>
                                <a href="single.html" class="dropdown-item">Blog Detail</a>
                                <a href="destination.html" class="dropdown-item">Destination</a>
                                <a href="guide.html" class="dropdown-item">Travel Guides</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div> -->
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class=" style">
        <div class="card border-0">
            <div class="card-header bg-primary text-center p-4">
                <h1 class="text-white m-0">Sign Up Now</h1>
            </div>
            <div class="card-body rounded-bottom bg-white p-5 form">
                <?php
                if (isset($erreur)) {
                    echo "<p style='color: red;'>$erreur</p>";
                } ?>
                <form action="" method="post">

                    <div class="form-group">
                        <input type="email" class="form-control p-4" placeholder="email" name="email" required="required" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control p-4" placeholder="mot de passe" name="mot_de_passe" required="required" />
                    </div>
                    <div class="form-group">
                        <p>Vous n'avez pas un compte <a href="inscription.php">S'inscrire</a> </p>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3" type="submit">Sign Up Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

                    <a class="btn btn-outline-primary btn-square mr-2" href="https://www.facebook.com/Abdoussamad/facebook.com/messages/"><i class="fab fa-facebook-f"></i></a>
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
</body>

</html>