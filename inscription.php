<?php
session_start();


if (isset($_SESSION['idclient'])) {
    header("Location: profil.php");
    exit();
}


$nom = $prenom = $email = $telephone = "";
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('connexion.php');


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $motDePasse = $_POST['mot_de_passe'];


    $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);



    $requeteEmailExiste = $connexion->prepare("SELECT idclient FROM Clients WHERE email = ?");
    $requeteEmailExiste->execute([$email]);
    $emailExiste = $requeteEmailExiste->fetch();

    if ($emailExiste) {
        $erreur = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
    } else {

        $requeteInsertion = $connexion->prepare("INSERT INTO clients (nom, prenom, email, tel, mot_de_passe) VALUES (?, ?, ?, ?, ?)");



        $requeteInsertion->execute([$nom, $prenom, $email, $telephone, $motDePasseHash]);


        header("Location: login.php");

        exit();
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
    <!-- <link rel="stylesheet" href="style.css"> -->

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
    <?php require_once('header.php'); ?>
    <div class=" style">
        <div class="card border-0">
            <div class="card-header bg-primary text-center p-4">
                <h1 class="text-white m-0">Formulaire d'inscription</h1>
            </div>
            <div class="card-body rounded-bottom bg-white p-5 form">
                <?php
                if (isset($erreur)) {
                    echo "<p style='color: red;'>$erreur</p>";
                } ?>


                <form action="" method="post">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input class="form-control p-4" type="text" name="nom" pattern="[a-zA-Z]+" title="Le nom doit contenir uniquement des lettres" placeholder="Votre nom..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input class="form-control p-4" type="text" name="prenom" pattern="[a-zA-Z]+" title="Le prénom doit contenir uniquement des lettres" placeholder="Votre prenom..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input class="form-control p-4" type="email" name="email" placeholder="Votre email..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone :</label>
                        <input class="form-control p-4" type="tel" name="telephone" pattern="[0-9]+" title="Le numéro de téléphone doit contenir uniquement des chiffres" placeholder="Votre téléphone..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="mot_de_passe">Mot de passe :</label>
                        <input class="form-control p-4" type="password" name="mot_de_passe" placeholder="Mot de passe..." required><br>
                    </div>

                    <div>
                        <button class="btn btn-primary btn-block py-3" type="submit">s'inscrire </button>

                    </div>

                </form>
            </div>
        </div>
    </div>



    <?php require_once('footer.php'); ?>

</body>

</html>