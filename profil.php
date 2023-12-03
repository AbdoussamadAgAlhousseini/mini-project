<?php

session_start();


if (!isset($_SESSION["idclient"])) {

    header("Location:login.php");
    exit();
}


$id = isset($_SESSION["idclient"]) ? $_SESSION["idclient"] : "Utilisateur";
$nom_utilisateur = isset($_SESSION['nom']) ? $_SESSION['nom'] : "Utilisateur";
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

// 
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
            <p>Email: <?php echo $email; ?></p>
            <p>id: <?php echo $id; ?></p>
            <a href="deconnexion.php">Se déconnecter</a>
        </div>
    </div>
    <?php require_once('footer.php'); ?>

</body>

</html>