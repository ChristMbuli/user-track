<?php
// Connexion à la base de données MySQL
$mysqli = new mysqli("localhost", "root", "", "user_track");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer l'adresse IP du visiteur
$ip_address = $_SERVER['REMOTE_ADDR'];

// Insérer la visite dans la table visitors
$insert_visitor_query = "INSERT INTO visitors (ip_address, visit_time) VALUES ('$ip_address', NOW())";
$mysqli->query($insert_visitor_query);

// Mettre à jour le nombre de visites pour la journée actuelle
$today_date = date("Y-m-d");
$update_daily_visits_query = "INSERT INTO daily_visits (visit_date, visit_count) VALUES ('$today_date', 1)
                              ON DUPLICATE KEY UPDATE visit_count = visit_count + 1";
$mysqli->query($update_daily_visits_query);

// Fermer la connexion à la base de données
$mysqli->close();