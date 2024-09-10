<?php 
include('db_connect.php'); // Inclut le fichier de connexion à la base de données
session_start(); // Démarre une session PHP

// Tableau pour les types d'utilisateurs basés sur le type de connexion
$utype = array('','users','staff','customers');

// Vérifie si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupère les données de l'utilisateur correspondant à l'ID fourni
    $user = $conn->query("SELECT * FROM {$utype[$_SESSION['login_type']]} where id =" . $_GET['id']);
    
    // Affecte les données de l'utilisateur à un tableau associatif $meta
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <div id="msg"></div> <!-- Zone pour afficher les messages d'erreur -->

    <!-- Formulaire pour gérer les utilisateurs -->
    <form action="" id="manage-user">
        <!-- Champ caché pour stocker l'ID de l'utilisateur -->
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
        
        <!-- Champ pour le prénom de l'utilisateur -->
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
        </div>
        
        <!-- Champ pour le nom du milieu de l'utilisateur -->
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo isset($meta['middlename']) ? $meta['middlename'] : '' ?>">
        </div>
        
        <!-- Champ pour le nom de famille de l'utilisateur -->
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
        </div>
        
        <!-- Champ pour l'email de l'utilisateur -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required autocomplete="off">
        </div>
        
        <!-- Champ pour le mot de passe de l'utilisateur -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
            <small><i>Leave this blank if you don't want to change the password.</i></small>
        </div>
        
    </form>
</div>

<script>
    // Gestionnaire d'événements pour la soumission du formulaire
    $('#manage-user').submit(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire
        start_load(); // Démarre un indicateur de chargement

        // Effectue une requête AJAX pour soumettre le formulaire
        $.ajax({
            url: 'ajax.php?action=update_user', // URL de la requête AJAX
            method: 'POST', // Méthode HTTP
            data: $(this).serialize(), // Sérialise les données du formulaire
            success: function(resp) {
                if (resp == 1) { // Si la réponse est 1, l'enregistrement est réussi
                    alert_toast("Data successfully saved", 'success'); // Affiche un message de succès
                    setTimeout(function() {
                        location.reload(); // Recharge la page après un délai
                    }, 1500);
                } else { // Sinon, affiche un message d'erreur
                    $('#msg').html('<div class="alert alert-danger">Username already exists</div>');
                    end_load(); // Arrête l'indicateur de chargement
                }
            }
        });
    });
</script>
