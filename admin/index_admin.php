<?php
/*
        $sever = 'localhost';
        $login = 'root';
        $code = 'root';
        $dbame = 'Visitors';
        $dns = 'mysql:host=$server;dbname=$dbname';

        try {
            $connexion = new PDO($dns, $login, $code  );
            
            echo "connexion reussie";
        } 
        catch (PDOException $e) {
            echo 'echec de connexion'.$e->getMessage();

        }*/
$host = 'localhost'; // le nom d'hôte de la base de données
$dbname = 'Visitors'; // le nom de la base de données
$username = 'root'; // le nom d'utilisateur de la base de données
$password = 'root'; // le mot de passe de la base de données

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; // le Data Source Name (DSN) de la base de données

try {
    $pdo = new PDO($dsn, $username, $password);
    echo 'connexion reussie';
    // configurez les options de PDO selon vos besoins
} catch (PDOException $e) {
    echo 'echec de connexion';
    // traitement de l'erreur de connexion
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        /* Style pour l'effet */
        .shake {
            transform: translateX(10px);
        }
    </style>
</head>

<body>

    <form id="loginForm">
        <h2>Admin Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="Nom" placeholder="Nom" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="password" required>

        <button type="button" onclick="login()">Login</button>
    </form>

    <script>
        function login() {
            var form = document.getElementById('loginForm');
            form.classList.add('shake');

            // Supprime la classe après l'animation
            setTimeout(function() {
                form.classList.remove('shake');
            }, 300);
        }
    </script>

</body>

</html>