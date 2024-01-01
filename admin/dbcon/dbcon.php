<?php
    $server = "localhost";
    $user = "root";
    $password = "root";
    $dataBase = "agence_tour";

    try {
        $dbcon = new PDO("mysql:host=$server;
        dbname = $dataBase", $user, $password);

        $dbcon->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("echec de la connexion : ". $e->getmessage()); 
    }

?>