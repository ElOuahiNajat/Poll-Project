<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro Page</title>
    <link rel="icon" type="image/png" href="ocpImg.png">
    
    <style>
        /* Styles pour le body et la vidéo */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1;
        }

        .header img {
            width: 150px; /* Ajustez la taille du logo ici */
            border-radius: 50%; /* Arrondir le logo */
        }

        .content {
            position: relative;
            color: #fff;
            text-align: center;
            padding: 40px;
            font-family: 'Arial', sans-serif;
            background: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
            border-radius: 10px; /* Coins arrondis */
            max-width: 800px;
            margin: 0 auto; /* Centrer le contenu */
            top: 50%;
            transform: translateY(-50%); /* Centrer verticalement */
        }

        .content h1 {
            font-size: 2em;
            margin: 0 0 20px;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8); /* Ombre portée */
            letter-spacing: 1px; /* Espacement des lettres */
            color: #98FF98; /* Couleur claire */
            animation: fadeIn 2s ease-out; /* Animation d'apparition */
        }

        .content p {
            font-size: 1.5em;
            margin: 0;
            line-height: 1.6;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7); /* Ombre portée */
        }

        .content button {
            background-color: #28a745; /* Couleur de fond verte */
            border: none;
            color: #fff; /* Couleur du texte */
            padding: 15px 30px; /* Espacement intérieur */
            font-size: 1.2em;
            border-radius: 5px; /* Coins arrondis */
            cursor: pointer; /* Curseur main pour le bouton */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Transitions douces */
            margin-top: 20px; /* Espacement au-dessus du bouton */
        }

        .content button:hover {
            background-color: #218838; /* Couleur de fond verte au survol */
            transform: scale(1.05); /* Agrandissement léger au survol */
        }

        .content button:active {
            background-color: #1e7e34; /* Couleur de fond verte lors du clic */
            transform: scale(0.98); /* Réduction légère lors du clic */
        }

        /* Animation d'apparition pour l'en-tête */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Vidéo en arrière-plan -->
    <video autoplay muted loop class="video-background">
        <source src="vidOcp.mp4" type="video/mp4">
        Votre navigateur ne prend pas en charge la vidéo HTML5.
    </video>

    <!-- Logo -->
    <div class="header">
        <img src="logoRE.png" alt="Logo OCP">
    </div>

    <!-- Contenu de la page -->
    <div class="content">
        <h1>Welcome to OCP's Pulse Point!</h1>
        <button id="getStartedBtn">Get Started</button>
    </div>

    <script>
        document.getElementById('getStartedBtn').addEventListener('click', function() {
            window.location.href = 'chargementPage.php';
        });
    </script>
</body>
</html>
