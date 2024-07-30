<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors Counter</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Nombre de visiteurs</h1>
        <div class="card mx-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Visiteurs aujourd'hui</h5>
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

                // Récupérer le nombre de visites pour la journée actuelle
                $get_daily_visits_query = "SELECT visit_count FROM daily_visits WHERE visit_date = '$today_date'";
                $result = $mysqli->query($get_daily_visits_query);
                $row = $result->fetch_assoc();
                $daily_visits = $row['visit_count'];

                // Afficher le nombre de visites pour la journée actuelle
                echo "<p class='card-text'>$daily_visits</p>";

                // Fermer la connexion à la base de données
                $mysqli->close();
                ?>

            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>