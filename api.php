<?php
// Connexion à la base de données MySQL
$mysqli = new mysqli("localhost", "root", "", "user_track");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer le nombre de visites pour la journée actuelle
$today_date = date("Y-m-d");
$get_daily_visits_query = "SELECT visit_count FROM daily_visits WHERE visit_date = '$today_date'";
$result = $mysqli->query($get_daily_visits_query);
$row = $result->fetch_assoc();
$daily_visits = $row['visit_count'];

// Fermer la connexion à la base de données
$mysqli->close();

// Renvoyer le nombre de visites
echo $daily_visits;