<?php
$serveur = "localhost"; 
$utilisateur = "root"; 
$motDePass = "root"; 
$baseDeDonnees = "Projet"; 

try {
    
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePass);

    $depart = $_POST['departure_date'];
    $destinationId = $_POST['destination'];
    $dateRetour = $_POST['return-date'];
    $nombre = $_POST['nbr_personne'];

    $destinationId = $connexion->query("SELECT DestinationID FROM Destinations WHERE NomDestination = '$destinationId'")->fetchColumn();


    $sql = $connexion->prepare("INSERT INTO ReservationsVols (DateDepart, DateRetour, DestinationId, NombrePassagers) VALUES (?, ?, ?, ?)");
    $sql->execute([$depart, $dateRetour, $destinationId, $nombre]);

    

    
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "vols enregistre ";
} catch (PDOException $e) {
    echo "Erreur lors de  engistre vol : " . $e->getMessage();
} finally {
    $connexion = null;
}
?>


