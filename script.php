<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $starNumber = $_POST["starNumber"];

    // Paramètres de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "projet";

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparez la requête d'insertion avec une déclaration préparée pour éviter les injections SQL
        $stmt = $conn->prepare("INSERT INTO Notations (idclient, DestinationID, Note) VALUES (:idclient, :destinationID, :starNumber)");

        // Ajoutez des valeurs fictives pour idclient et DestinationID (ajustez-les en fonction de vos besoins)
        // $idclient = 1;
        $destinationID = $_SESSION['destinationId'];

        // Liez les paramètres
        $stmt->bindParam(':idclient', $idclient, PDO::PARAM_INT);
        $stmt->bindParam(':destinationID', $destinationID, PDO::PARAM_INT);
        $stmt->bindParam(':starNumber', $starNumber, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        echo "La note a été insérée avec succès dans la base de données.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion de la note : " . $e->getMessage();
    }

    // Fermez la connexion
    $conn = null;
}
