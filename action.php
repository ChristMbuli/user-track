<?php
// Connexion à la base de données MySQL
$mysqli = new mysqli("localhost", "root", "", "user_track");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer l'adresse IP du visiteur
$ip_address = $_SERVER['REMOTE_ADDR'];

// Récupérer la date d'aujourd'hui
$today_date = date("Y-m-d");

// Insérer ou mettre à jour la visite dans la table visitors
$insert_visitor_query = "INSERT INTO visitors (ip_address, visit_time) VALUES ('$ip_address', NOW()) 
                        ON DUPLICATE KEY UPDATE visit_count = visit_count + 1";
$mysqli->query($insert_visitor_query);

// Récupérer le nombre de visiteurs pour la journée actuelle
$get_daily_visits_query = "SELECT visit_count FROM visitors WHERE ip_address = '$ip_address' AND DATE(visit_time) = '$today_date'";
$result = $mysqli->query($get_daily_visits_query);
$row = $result->fetch_assoc();
$daily_visits = $row['visit_count'];

// Fermer la connexion à la base de données
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre de Visiteurs</title>
</head>

<body>
    <h1>Date : <?= $today_date ?></h1>
    <h2>Nombre de Visiteurs Aujourd'hui : <?= $daily_visits ?></h2>
</body>

</html>