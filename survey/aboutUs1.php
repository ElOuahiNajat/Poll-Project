<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Navbar Styles */
.navbar {
    background-color: #2d6a4f; /* Couleur de fond verte foncée */
    border-bottom: 3px solid #1e4d40; /* Bordure verte plus foncée en bas */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre pour donner de la profondeur */
    width: 100%; /* S'assurer que la navbar couvre toute la largeur */
    position: fixed; /* Fixer la navbar en haut de la page */
    top: 0;
    left: 0;
    z-index: 1030; /* S'assurer qu'elle est au-dessus des autres contenus */
    padding: 0.75rem 1.5rem; /* Ajouter un padding interne */
    transition: background-color 0.3s ease; /* Transition pour l'effet de défilement */
}

.navbar.scrolled {
    background-color: #004d00; /* Couleur de fond lorsque défilement */
}

.navbar-logo {
    max-height: 40px; /* Ajuster la hauteur du logo */
    width: auto; /* Conserver le ratio d'aspect */
    transition: transform 0.3s ease; /* Transition pour l'animation */
    border-radius: 50%; /* Bordure circulaire pour le logo */
    overflow: hidden; /* Éviter le dépassement du contenu */
}

.navbar-logo:hover {
    transform: scale(1.1); /* Effet d'agrandissement au survol */
}

.navbar-nav .nav-link {
    color: #ffffff !important;
    font-weight: 600;
}

.navbar-nav .nav-link:hover {
    color: #d0e5d0 !important;
}

    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="">
            <img src="logoRE.png" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="intro.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="s.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="s.php">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="s.php">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="intro.php">Contat Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Add your content here -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script >
        $(document).ready(function() {
    // Scroll to top functionality
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });
});

    </script>
</body>
</html>
