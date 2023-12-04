<?php
session_start();

if (isset($_SESSION['idclient'])) {
    header("Location: profil.php");


    exit();
} else {
    header("Location: login.php");
}
