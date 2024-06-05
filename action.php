<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackViz</title>
    <link rel="shortcut icon" href="./TrackViz.png" class="rounded" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
            <div class="flex justify-center mb-8">
                <img src="./logo.png" alt="Logo" class="w-40 h-30">
            </div>
            <h1 class="text-2xl font-semibold text-center text-gray-500 mt-8 mb-6">Nombre Visiteurs :
                <span id="dailyVisits">Chargement...</span>
            </h1>
            <p class="text-sm text-gray-600 text-justify mt-8 mb-6">Plongez dans TrackViz : la solution de suivi des
                visiteurs par excellence. Suivez les activités de vos visiteurs en temps réel, explorez les données avec
                VizBoard pour optimiser l'expérience utilisateur. Découvrez TrackViz, la création de <a href="#"
                    class="underline">Christ
                    Mbuli</a>.</p>


            <p class="text-xs text-gray-600 text-center mt-8">&copy; 2024 <a href="underline">Christ Mbuli</a> , All
                rights reserved.
            </p>
        </div>
    </div>

    <script>
    // Fonction pour mettre à jour le nombre de visites
    function updateDailyVisits() {
        // Effectuer une requête AJAX pour récupérer le nombre de visites actuel
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Mettre à jour le contenu de la balise span avec le nombre de visites
                    document.getElementById("dailyVisits").textContent = xhr.responseText;
                } else {
                    console.error('Erreur lors de la récupération du nombre de visites:', xhr.status);
                }
            }
        };
        xhr.open("GET", "./api.php", true);
        xhr.send();
    }

    // Appeler la fonction pour la première fois
    updateDailyVisits();

    // Mettre à jour le nombre de visites toutes les 5 secondes
    setInterval(updateDailyVisits, 5000); // 5000 millisecondes = 5 secondes
    </script>
</body>

</html>