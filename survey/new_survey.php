<?php
// Vérifie si la connexion à la base de données n'est pas encore établie
if (!isset($conn)) {
    include 'db_connect.php'; // Inclut le fichier de connexion à la base de données
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Survey</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eaf0f1; /* Soft light gray background */
            color: #333; /* Dark text for readability */
            font-family: 'Arial', sans-serif; /* Clean sans-serif font */
            animation: fadeIn 1s ease-in;
        }
        .card {
            border: none;
            border-radius: 1rem;
            background: #ffffff; /* White card background */
            color: #333; /* Dark text in card */
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02); /* Slight zoom-in on hover */
            box-shadow: 0 6px 15px rgba(0, 128, 0, 0.3); /* Green glow effect */
        }
        .card-header {
            background-color: #2d6a4f; /* Deep green */
            color: #ffffff; /* White text */
            font-weight: bold;
            border-bottom: 2px solid #1e4d40; /* Slightly darker green border */
            padding: 1rem;
            font-size: 1.5rem;
        }
        .btn-primary {
            background-color: #2d6a4f; /* Deep green */
            border-color: #2d6a4f;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            padding: 0.5rem 1.25rem;
        }
        .btn-primary:hover {
            background-color: #1e4d40; /* Darker green */
            border-color: #1e4d40;
        }
        .btn-secondary {
            background-color: #ffffff; /* White */
            border-color: #2d6a4f; /* Deep green border */
            color: #2d6a4f; /* Deep green text */
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            padding: 0.5rem 1.25rem;
        }
        .btn-secondary:hover {
            background-color: #f8f9fa; /* Light gray */
            border-color: #1e4d40; /* Darker green border */
            color: #1e4d40; /* Darker green text */
        }
        .form-control, .custom-select {
            border-radius: 0.5rem;
            border-color: #2d6a4f; /* Deep green border */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus, .custom-select:focus {
            border-color: #1e4d40; /* Darker green on focus */
            box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.25); /* Green shadow on focus */
        }
        .form-group label {
            font-weight: 500;
            color: #333; /* Dark text for labels */
        }
        .alert-danger {
            font-size: 0.875rem;
            background-color: #f8d7da; /* Light red background */
            border-color: #f5c6cb; /* Light red border */
            color: #721c24; /* Dark red text */
        }
        .text-muted {
            color: #6c757d; /* Medium gray */
        }
        .text-success {
            color: #2d6a4f; /* Deep green */
        }
        .text-danger {
            color: #dc3545; /* Red */
        }
        hr {
            border-color: #2d6a4f; /* Deep green */
        }
        /* Animation for the page load */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        body {
            animation: fadeIn 1s ease-in;
        }
        .col-md-6 {
            padding: 1rem;
        }
        .col-lg-12 {
            padding: 0;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Manage Survey</h4>
            </div>
            <div class="card-body">
                <!-- Formulaire pour gérer les sondages -->
                <form action="" id="manage_survey">
                    <!-- Champ caché pour stocker l'ID du sondage (si disponible) -->
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    
                    <div class="row">
                        <!-- Colonne pour les informations de base du sondage -->
                        <div class="col-md-6 border-right">
                            <!-- Champ pour le titre du sondage -->
                            <div class="form-group">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control form-control-sm" required value="<?php echo isset($stitle) ? htmlspecialchars($stitle) : '' ?>">
                            </div>
                            
                            <!-- Champ pour la date de début du sondage -->
                            <div class="form-group">
                                <label for="start_date" class="control-label">Start</label>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" required value="<?php echo isset($start_date) ? htmlspecialchars($start_date) : '' ?>">
                            </div>
                            
                            <!-- Champ pour la date de fin du sondage -->
                            <div class="form-group">
                                <label for="end_date" class="control-label">End</label>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" required value="<?php echo isset($end_date) ? htmlspecialchars($end_date) : '' ?>">
                            </div>
                        </div>
                        
                        <!-- Colonne pour la description du sondage -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description" class="control-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="4" class="form-control" required><?php echo isset($description) ? htmlspecialchars($description) : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Boutons pour sauvegarder ou annuler -->
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href = 'index.php?page=survey_list'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Gestionnaire d'événements pour la soumission du formulaire
        $('#manage_survey').submit(function(e) {
            e.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire
            $('input').removeClass("border-danger"); // Retire les classes d'erreur des champs de saisie
            start_load(); // Démarre l'indicateur de chargement

            $('#msg').html(''); // Vide le message d'erreur
            
            // Effectue une requête AJAX pour soumettre le formulaire
            $.ajax({
                url: 'ajax.php?action=save_survey', // URL de la requête AJAX
                data: new FormData($(this)[0]), // Sérialise les données du formulaire
                cache: false, // Désactive la mise en cache
                contentType: false, // Ne définit pas le type de contenu
                processData: false, // Ne traite pas les données automatiquement
                method: 'POST', // Méthode HTTP
                type: 'POST', // Type de la requête
                success: function(resp) {
                    if (resp == 1) { // Si la réponse est 1, l'enregistrement est réussi
                        alert_toast('Data successfully saved.', "success"); // Affiche un message de succès
                        setTimeout(function() {
                            location.replace('index.php?page=survey_list'); // Redirige vers la liste des sondages après un délai
                        }, 1500);
                    }
                }
            });
        });
    </script>
</body>
</html>
