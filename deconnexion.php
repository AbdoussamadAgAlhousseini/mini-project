<?php
session_start(); // Démarrer la session

// Effacer toutes les variables de session
session_unset();

// Arrêter la session
session_destroy();
header("Location:login.php");
