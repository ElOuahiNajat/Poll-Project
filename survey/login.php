<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login to PhosPoll</title>
    <link rel="icon" type="image/png" href="ocpImg.png">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* General Reset */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Éviter le défilement horizontal */
        }

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

        /* Animation pour le logo */
        .navbar .navbar-brand img {
            max-height: 40px; /* Ajuster la hauteur du logo */
            width: auto; /* Conserver le ratio d'aspect */
            transition: transform 0.3s ease; /* Transition pour l'animation */
            border-radius: 50%; /* Bordure circulaire pour le logo */
            overflow: hidden; /* Éviter le dépassement du contenu */
        }

        .navbar .navbar-brand img:hover {
            transform: scale(1.1); /* Effet d'agrandissement au survol */
        }

        /* Navbar Button Styles */
        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            color: #d0e5d0 !important;
        }

        /* Main Content Styles */
        main#main {
            width: 100%;
            margin-top: 56px; /* Ajuster pour éviter que le contenu soit caché sous la navbar fixe */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5; /* Couleur de fond légère */
            height: calc(100vh - 56px); /* Ajuster la hauteur du contenu principal */
            transition: opacity 0.5s ease; /* Transition pour l'animation de chargement */
        }

        /* Ajout d'un effet de fondu */
        .login-container {
            width: 900px;
            max-width: 90%;
            display: flex;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
            transform: translateY(10px); /* Position initiale pour l'animation */
            opacity: 0; /* Opacité initiale */
            animation: fadeInUp 0.5s forwards; /* Animation de fade in */
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0); /* Position finale */
                opacity: 1; /* Opacité finale */
            }
        }

        .login-container .left {
            width: 50%;
            background: url('imgOcp2.jpg') center center no-repeat;
            background-size: cover;
            transition: transform 0.5s ease;
        }

        .login-container .right {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #e9f5e8;
            transition: background-color 0.3s ease; /* Transition pour l'effet de survol */
        }

        .login-container .right:hover {
            background-color: #d0e5d0; /* Couleur de fond lors du survol */
        }

        .right h4 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 20px;
            color: #00490e !important;
            font-size: 24px;
            animation: slideIn 0.5s ease; /* Animation pour le titre */
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px); /* Position initiale */
                opacity: 0; /* Opacité initiale */
            }
            to {
                transform: translateY(0); /* Position finale */
                opacity: 1; /* Opacité finale */
            }
        }

        .form-group label {
            font-weight: 600;
            color: #004d00;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease; /* Transition pour l'effet de focus */
        }

        .form-control:focus {
            border-color: #004d00;
            box-shadow: 0 0 8px rgba(0, 77, 0, 0.5);
        }

        /* Animation pour les boutons */
        .btn-primary {
            background-color: #004d00;
            border-color: #004d00;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transitions pour l'effet de survol */
        }

        .btn-primary:hover {
            background-color: #003d00;
            border-color: #003d00;
            transform: scale(1.05); /* Effet d'agrandissement au survol */
        }

        .alert-danger {
            color: #dc3545;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            animation: slideIn 0.5s ease; /* Animation pour les alertes */
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #004d00;
            color: white;
            border-radius: 50%;
            padding: 10px;
            text-align: center;
            font-size: 24px;
            cursor: pointer;
            display: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease; /* Transitions pour l'effet de survol */
        }

        .back-to-top:hover {
            background: #003d00;
            transform: scale(1.1); /* Effet d'agrandissement au survol */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="">
            <img src="logoRE.png" alt="Online Survey System Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="intro.php">Intro Page </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <main id="main">
        <div class="login-container">
            <div class="left"></div>
            <div class="right">
                <h4 class="text-primary">Welcome to PhosPoll !</h4>
                <div id="login-center" class="row justify-content-center">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" id="email" name="email" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm">
                            </div>
                            <center><button type="submit" class="btn btn-primary btn-block">Login</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Scroll to top functionality
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn();
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.back-to-top').fadeOut();
                    $('.navbar').removeClass('scrolled');
                }
            });

            $('.back-to-top').click(function() {
                $('html, body').animate({scrollTop: 0}, 500);
                return false;
            });

            $('#login-form').submit(function(e) {
                e.preventDefault();
                $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');

                if ($(this).find('.alert-danger').length > 0) {
                    $(this).find('.alert-danger').remove();
                }

                $.ajax({
                    url: 'ajax.php?action=login',
                    method: 'POST',
                    data: $(this).serialize(),
                    error: err => {
                        console.log(err);
                        $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                    },
                    success: function(resp) {
                        if (resp == 1) {
                            location.href = 'index.php?page=home';
                        } else {
                            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                            $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
