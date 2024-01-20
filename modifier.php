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
    $tel = $_POST["tel"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Validate and sanitize the input data as needed

    // Update the client information in the database
    $connexion = "UPDATE clients SET nom=?, prenom=?, email=?, tel=?, mot_de_passe=? WHERE idclient=?";
    $stmt = $pdo->prepare($connexion);
    $stmt->execute([$nom, $prenom, $email, $tel, $mot_de_passe, $idclient]);

    // Redirect to a confirmation page or reload the current page
    header("Location: profil.php");
    exit();
} else {
    // Display the form with current client information
    $idclient = $_GET["idclient"]; // You may need to validate and sanitize this input
    $connexion = "SELECT * FROM clients WHERE idclient=?";
    $stmt = $pdo->prepare($connexion);
    $stmt->execute([$idclient]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <!-- HTML form for updating client information -->
    <form method="post" action="#">
        <input type="hidden" name="idclient" value="<?php echo $client['idclient']; ?>">
        Nom: <input type="text" name="nom" value="<?php echo $client['nom']; ?>"><br>
        Prenom: <input type="text" name="prenom" value="<?php echo $client['prenom']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $client['email']; ?>"><br>
        Téléphone: <input type="text" name="tel" value="<?php echo $client['tel']; ?>"><br>
        Mot de passe: <input type="password" name="mot_de_passe" value="<?php echo $client['mot_de_passe']; ?>"><br>
        <input type="submit" value="Modifier">
    </form>

<?php } ?>