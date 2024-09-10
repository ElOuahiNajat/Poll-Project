<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/png" href="ocpImg.png">
    <style>
        /* Styles de la page */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            overflow: hidden;
        }

        /* Styles du loader */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 1.5em;
            z-index: 1000;
        }

        /* Animation de la barre de progression */
        .progress-bar {
            width: 80%;
            max-width: 400px;
            background: #333;
            border-radius: 25px;
            overflow: hidden;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .progress-bar-fill {
            height: 30px;
            background: #4caf50;
            width: 0%;
            text-align: center;
            line-height: 30px;
            color: white;
            border-radius: 25px;
            transition: width 0.3s ease, background 0.3s ease;
            font-weight: bold;
        }

        /* Styles du texte de chargement */
        #loading-text {
            margin: 10px 0;
            font-size: 1.2em;
        }

        /* Animation du texte de chargement */
        @keyframes loadingAnimation {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }

        #loading-text {
            animation: loadingAnimation 1s infinite;
        }
    </style>
</head>
<body>
    
    <!-- Écran de chargement -->
    <div id="loader" class="loader">
        <div class="progress-bar">
            <div id="progress" class="progress-bar-fill">0%</div>
        </div>
        <p id="loading-text">Chargement...</p>
    </div>

    <script>
        // Code JavaScript pour gérer l'affichage du contenu après le chargement
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            const progress = document.getElementById('progress');

            let percent = 0;

            // Simule la progression du chargement
            const interval = setInterval(() => {
                percent += 10;
                progress.style.width = percent + '%';
                progress.textContent = percent + '%';

                // Change la couleur de la barre de progression en fonction du pourcentage
                if (percent >= 80) {
                    progress.style.backgroundColor = '#ff9800'; // Orange pour les dernières étapes
                } 
                if (percent >= 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        loader.style.opacity = '0';  // Efface l'écran de chargement en diminuant son opacité
                        setTimeout(() => {
                            loader.style.display = 'none';  // Cache l'écran de chargement
                            // Redirige vers intro.php après un court délai
                            window.location.href = 'aboutUs.php';
                        }, 300); // Délai pour la transition d'opacité
                    }, 500); // Délai pour laisser le temps de voir le 100%
                }
            }, 300); // Met à jour la progression toutes les 300 ms
        });
    </script>
</body>
</html>
