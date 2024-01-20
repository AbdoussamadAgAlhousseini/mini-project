<?php
require_once("dbcon.php");

if (isset($_POST["ajouter"])) {
    $nom = $_POST["nom_destination"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];

    // Vérifier si le fichier a été téléchargé avec succès
    if (!isset($_FILES["photos"]) || $_FILES["photos"]["error"] != UPLOAD_ERR_OK) {
        echo "Erreur lors du téléchargement du fichier.";
        exit();
    }

    // Récupérer le contenu du fichier
    $photos = file_get_contents($_FILES["photos"]["tmp_name"]);

    if (!is_string($nom)) {
        echo "Le nom de la destination doit être une chaîne de caractères.";
        exit();
    }

    if (!is_string($description)) {
        echo "La description doit être une chaîne de caractères.";
        exit();
    }

    if (!is_numeric($prix)) {
        echo "Le prix doit être un nombre.";
        exit();
    }

    try {
        $sql = "INSERT INTO destinations (NomDestination, Description, Prix, image) VALUES (:nom, :description, :prix, :photos)";
        $stmt = $connexion->prepare($sql);

        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":prix", $prix, PDO::PARAM_INT);
        $stmt->bindParam(":photos", $photos, PDO::PARAM_LOB); // Utiliser PDO::PARAM_LOB pour les données binaires

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo "L'enregistrement n'a pas pu être ajouté.";
        }

        $stmt = null;
    } catch (PDOException $e) {
        echo "Erreur d'exécution de la requête : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
            
    <div class="sidebar">
            <a href="dashboard.html"><h2>ALMA</h2></a>
            <a href="dashboard.html">Dashboard</a>
            <a href="admin.php">Admin</a>
            <a href="booking.php">Bookings</a>
            <a href="vols.php">Flights</a>
            <a href="hotels.php">Hotels</a>
        </div>
    <div class="form-con">
        <div class="headline">
            <h2>welcome to admin dashboard</h2>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nom_destination">Nom de destination</label>
            <input type="text" name="nom_destination" id="nom_destination" class="form-control" />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description">
          </div>
          <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" />
          </div>
          <div class="form-group">
            <label for="photos">Photos</label>
            <input type="file" name="photos" id="photos" accept="image/*" multiple>
            
          </div>
          <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </form>
        
    </div>

</body>
</html>

