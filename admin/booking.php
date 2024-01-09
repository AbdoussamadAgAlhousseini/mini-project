<?php
require_once("dbcon.php");

    if (isset($_POST["ajouter"])) {
        $nom = $_POST["nom_destination"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];

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

        $sql = "INSERT INTO destinations (NomDestination, Description, Prix) VALUES (:nom, :description, :prix)";

        $stmt = $connexion->prepare($sql);

        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":prix", $prix, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo "L'enregistrement n'a pas pu être ajouté.";
        }
        $stmt = null;
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
            <h2>ALMA</h2>
            <a href="dashboard.html">Dashboard</a>
            <a href="admin.php">Admin</a>
            <a href="booking.html">Bookings</a>
            <a href="flights.html">Flights</a>
            <a href="hotels.html">Hotels</a>
        </div>

        <form action="" method="post"> <!-- Changed action to admin.php -->
          <div class="form-group">
            <label for="nom_destination">Nom de destination</label>
            <input type="text" name="nom_destination" id="nom_destination" class="form-control" />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="">
          </div>
          <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" />
          </div>
          <button type="submit" name="ajouter" class="btn btn-primary" >Ajouter</button> <!-- Added name attribute to submit button -->
        </form>
        
</body>
</html>
