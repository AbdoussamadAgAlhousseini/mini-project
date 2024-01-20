<?php
session_start();
// Assuming you have a database connection established
$idclient = $_SESSION["idclient"];
require_once('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data when submitted

    $idclient = $_POST["idclient"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $tel = $_POST["telephone"];
    // $mot_de_passe = $_POST["mot_de_passe"];

    // Validate and sanitize the input data as needed

    // Hash the password
    // $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Update the client information in the database
    $requeteInsertion = $connexion->prepare("UPDATE clients SET nom=?, prenom=?, email=?, tel=? WHERE idclient=?");

    // Exécuter la requête avec les paramètres
    $requeteInsertion->execute([$nom, $prenom, $email, $tel, $idclient]);

    // Redirect to a confirmation page or reload the current page
    header("Location: deconnexion.php");
    exit();
} else {
    // Display the form with current client information
    // You may need to validate and sanitize this input

    $requete = $connexion->prepare("SELECT * FROM clients WHERE idclient = ?");
    $requete->execute([$idclient]);

    // Récupération du client
    $client = $requete->fetch(PDO::FETCH_ASSOC);
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
    <?php require_once('header.php'); ?>
    <div class=" style">
        <div class="card border-0">
            <div class="card-header bg-primary text-center p-4">
                <h1 class="text-white m-0">modification de vos informations</h1>
            </div>
            <div class="card-body rounded-bottom bg-white p-5 form">
                <?php
                // Correction : définir $erreur si nécessaire
                if (isset($erreur)) {
                    echo "<p style='color: red;'>$erreur</p>";
                }
                ?>

                <form action="#" method="post">
                    <input type="hidden" name="idclient" value="<?php echo $client['idclient']; ?>">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input class="form-control p-4" type="text" name="nom" pattern="[a-zA-Z]+" title="Le nom doit contenir uniquement des lettres" value="<?php echo $client['nom']; ?>" placeholder="Votre nom..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input class="form-control p-4" type="text" name="prenom" pattern="[a-zA-Z]+" title="Le prénom doit contenir uniquement des lettres" value="<?php echo $client['prenom']; ?>" placeholder="Votre prenom..." required><br>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input class="form-control p-4" type="email" name="email" placeholder="Votre email..." value="<?php echo $client['email']; ?>" required><br>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone :</label>
                        <input class="form-control p-4" type="tel" name="telephone" pattern="[0-9]+" title="Le numéro de téléphone doit contenir uniquement des chiffres" value="<?php echo $client['tel']; ?>" placeholder="Votre téléphone..." required><br>
                    </div>
                    <!-- <div class="form-group">
                        <label for="mot_de_passe">Mot de passe :</label>
                        <input class="form-control p-4" type="password" name="mot_de_passe" placeholder="Mot de passe..." value="<?php echo $client['mot_de_passe']; ?>"><br>
                    </div> -->

                    <div>
                        <button class="btn btn-primary btn-block py-3" type="submit">Modifier </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('footer.php') ?>
</body>

</html>