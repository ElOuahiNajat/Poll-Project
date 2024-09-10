<?php
//session_start(); // Start the session

// Sample data (replace these with your actual logic)
$id = isset($id) ? $id : '';
$firstname = isset($firstname) ? $firstname : '';
$middlename = isset($middlename) ? $middlename : '';
$lastname = isset($lastname) ? $lastname : '';
$contact = isset($contact) ? $contact : '';
$address = isset($address) ? $address : '';
$email = isset($email) ? $email : '';
$type = isset($type) ? $type : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
    </style>
</head>


<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">User Management</h4>
            </div>
            <div class="card-body">
                <!-- Formulaire pour gérer les informations des utilisateurs -->
                <form action="" id="manage_user">
                    <!-- Champ caché pour l'ID de l'utilisateur -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    
                    <div class="row">
                        <!-- Colonne pour les informations personnelles -->
                        <div class="col-md-6 border-right">
                            <b class="text-muted">Personal Information</b>
                            <!-- Champ pour le prénom -->
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" required value="<?php echo htmlspecialchars($firstname); ?>">
                            </div>
                            <!-- Champ pour le deuxième prénom -->
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control form-control-sm" value="<?php echo htmlspecialchars($middlename); ?>">
                            </div>
                            <!-- Champ pour le nom de famille -->
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" required value="<?php echo htmlspecialchars($lastname); ?>">
                            </div>
                            <!-- Champ pour le numéro de contact -->
                            <div class="form-group">
                                <label for="contact">Contact No.</label>
                                <input type="text" name="contact" id="contact" class="form-control form-control-sm" required value="<?php echo htmlspecialchars($contact); ?>">
                            </div>
                            <!-- Champ pour l'adresse -->
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" cols="30" rows="4" class="form-control" required><?php echo htmlspecialchars($address); ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Colonne pour les informations de connexion -->
                        <div class="col-md-6">
                            <b class="text-muted">System Credentials</b>
                            <!-- Si l'utilisateur est un administrateur -->
                            <?php if (isset($_SESSION['login_type']) && $_SESSION['login_type'] == 1): ?>
                            <div class="form-group">
                                <label for="type">User Role</label>
                                <select name="type" id="type" class="custom-select custom-select-sm">
                                    <option value="3" <?php echo $type == 3 ? 'selected' : ''; ?>>Subscriber</option>
                                    <option value="2" <?php echo $type == 2 ? 'selected' : ''; ?>>Staff</option>
                                    <option value="1" <?php echo $type == 1 ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <?php else: ?>
                                <!-- Si ce n'est pas un administrateur, définir le rôle par défaut comme "Subscriber" -->
                                <input type="hidden" name="type" value="3">
                            <?php endif; ?>
                            <!-- Champ pour l'email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required value="<?php echo htmlspecialchars($email); ?>">
                                <small id="msg"></small>
                            </div>
                            <!-- Champ pour le mot de passe -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm" name="password" id="password" <?php echo isset($id) ? '' : 'required'; ?>>
                                <small><i><?php echo isset($id) ? "Leave this blank if you don't want to change your password" : ''; ?></i></small>
                            </div>
                            <!-- Champ pour la confirmation du mot de passe -->
                            <div class="form-group">
                                <label for="cpass">Confirm Password</label>
                                <input type="password" class="form-control form-control-sm" name="cpass" id="cpass" <?php echo isset($id) ? 'required' : ''; ?>>
                                <small id="pass_match" data-status=''></small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Boutons pour sauvegarder ou annuler -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
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
        // Vérifie la correspondance des mots de passe lors de la saisie
        $('[name="password"],[name="cpass"]').keyup(function() {
            var pass = $('[name="password"]').val();
            var cpass = $('[name="cpass"]').val();
            
            if (cpass === '' || pass === '') {
                $('#pass_match').attr('data-status', '');
            } else {
                if (cpass === pass) {
                    $('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>');
                } else {
                    $('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>');
                }
            }
        });

        // Affiche l'image sélectionnée
        function displayImg(input, _this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#cimg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Gestionnaire d'événements pour la soumission du formulaire
        $('#manage_user').submit(function(e) {
            e.preventDefault(); // Empêche la soumission par défaut du formulaire
            $('input').removeClass("border-danger"); // Retire les classes d'erreur des champs de saisie
            start_load(); // Démarre l'indicateur de chargement
            $('#msg').html(''); // Vide le message d'erreur
            
            // Vérifie si les mots de passe correspondent
            if ($('#pass_match').attr('data-status') !== '1') {
                if ($("[name='password']").val() !== '') {
                    $('[name="password"],[name="cpass"]').addClass("border-danger");
                    end_load(); // Arrête l'indicateur de chargement
                    return false; // Arrête le processus de soumission
                }
            }
            
            // Effectue la requête AJAX pour soumettre le formulaire
            $.ajax({
                url: 'ajax.php?action=save_user', // URL pour la requête AJAX
                data: new FormData($(this)[0]), // Sérialise les données du formulaire
                cache: false, // Désactive la mise en cache
                contentType: false, // Ne définit pas le type de contenu
                processData: false, // Ne traite pas les données automatiquement
                method: 'POST', // Méthode HTTP
                type: 'POST', // Type de la requête
                success: function(resp) {
                    if (resp === '1') { // Si la réponse est 1, l'enregistrement est réussi
                        alert_toast('Data successfully saved.', "success"); // Affiche un message de succès
                        setTimeout(function() {
                            location.replace('index.php?page=user_list'); // Redirige vers la liste des utilisateurs après un délai
                        }, 750);
                    } else if (resp === '2') { // Si la réponse est 2, l'email existe déjà
                        $('#msg').html("<div class='alert alert-danger'>Email already exists.</div>");
                        $('[name="email"]').addClass("border-danger");
                        end_load(); // Arrête l'indicateur de chargement
                    }
                }
            });
        });
    </script>
</body>
</html>
