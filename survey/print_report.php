<?php include 'header.php'; ?> <!-- Inclut le fichier d'en-tête pour la mise en page -->
<?php include 'db_connect.php'; ?> <!-- Inclut le fichier de connexion à la base de données -->

<?php 
// Récupère les détails du sondage à partir de l'identifiant passé dans l'URL
$id = intval($_GET['id']); // Convertit l'ID en entier pour éviter les injections SQL
$qry = $conn->query("SELECT * FROM survey_set WHERE id = $id")->fetch_array();

// Crée des variables dynamiques pour chaque champ du sondage
foreach($qry as $k => $v) {
    if ($k == 'title') {
        $k = 'stitle'; // Renomme 'title' en 'stitle' pour une meilleure clarté
    }
    $$k = $v; // Crée unea variable avec le nom de la clé et la valeur associée
}

// Compte le nombre d'utilisateurs ayant répondu au sondage
$taken = $conn->query("SELECT DISTINCT(user_id) FROM answers WHERE survey_id = $id")->num_rows;

// Récupère toutes les réponses aux questions du sondage
$answers = $conn->query("SELECT a.*, q.type FROM answers a INNER JOIN questions q ON q.id = a.question_id WHERE a.survey_id = $id");
$ans = array(); // Tableau pour stocker les réponses

// Traite les réponses en fonction du type de question
while ($row = $answers->fetch_assoc()) {
    if ($row['type'] == 'radio_opt') {
        // Pour les questions à choix unique
        $ans[$row['question_id']][$row['answer']][] = 1;
    }
    if ($row['type'] == 'check_opt') {
        // Pour les questions à choix multiples
        foreach (explode(",", str_replace(array("[", "]"), '', $row['answer'])) as $v) {
            $ans[$row['question_id']][$v][] = 1;
        }
    }
    if ($row['type'] == 'textfield_s') {
        // Pour les questions à réponse libre
        $ans[$row['question_id']][] = $row['answer'];
    }
}
?>

<div class="col-lg-12">
    <!-- Affiche les détails du sondage -->
    <p>Title: <b><?php echo htmlspecialchars($stitle, ENT_QUOTES, 'UTF-8'); ?></b></p>
    <p class="mb-0">Description:</p>
    <small><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></small>
    <p>Start: <b><?php echo date("M d, Y", strtotime($start_date)); ?></b></p>
    <p>End: <b><?php echo date("M d, Y", strtotime($end_date)); ?></b></p>
    <p>Have Taken: <b><?php echo number_format($taken); ?></b></p>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Survey Report</b></h3>
                </div>
                <div class="card-body ui-sortable">
                    <?php 
                    // Affiche les questions à choix unique et multiples
                    $question = $conn->query("SELECT * FROM questions WHERE survey_id = $id AND type != 'textfield_s' ORDER BY ABS(order_by) ASC, ABS(id) ASC");
                    while ($row = $question->fetch_assoc()): 
                    ?>
                    <div class="callout callout-info">
                        <h5><?php echo htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8'); ?></h5>  
                        <div class="col-md-12">
                            <ul>
                                <?php foreach (json_decode($row['frm_option']) as $k => $v): 
                                    // Calcule le pourcentage de chaque option
                                    $prog = ((isset($ans[$row['id']][$k]) ? count($ans[$row['id']][$k]) : 0) / $taken) * 100;
                                    $prog = round($prog, 2); // Arrondit à deux décimales
                                ?>
                                <li>
                                    <div class="d-block w-100">
                                        <b><?php echo htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); ?></b>
                                    </div>
                                    <div class="d-flex w-100">
                                        <span class=""><?php echo isset($ans[$row['id']][$k]) ? count($ans[$row['id']][$k]) : 0; ?>/<?php echo $taken; ?></span>
                                        <div class="mx-1 col-sm-8">
                                            <div class="progress w-100">
                                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $prog; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog; ?>%">
                                                    <span class="sr-only"><?php echo $prog; ?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="badge badge-info"><?php echo $prog; ?>%</span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>  
                    </div>
                    <?php endwhile; ?>

                    <?php 
                    // Affiche les questions à réponse libre
                    $question = $conn->query("SELECT * FROM questions WHERE survey_id = $id AND type = 'textfield_s' ORDER BY ABS(order_by) ASC, ABS(id) ASC");
                    while ($row = $question->fetch_assoc()): 
                    ?>
                    <div class="callout callout-info">
                        <h5><?php echo htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8'); ?></h5>  
                        <div class="col-md-12 bg-dark py-1">
                            <div class="d-block tfield-area w-100">
                                <?php if (isset($ans[$row['id']])): ?>
                                <?php foreach ($ans[$row['id']] as $val): ?>
                                <blockquote class="text-dark"><?php echo htmlspecialchars($val, ENT_QUOTES, 'UTF-8'); ?></blockquote>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>  
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Gestion de la soumission du formulaire
    $('#manage-survey').submit(function(e) {
        e.preventDefault(); // Empêche la soumission par défaut du formulaire
        start_load(); // Démarre l'indicateur de chargement

        $.ajax({
            url: 'ajax.php?action=save_answer', // URL pour la requête AJAX
            method: 'POST', // Méthode HTTP pour la requête
            data: $(this).serialize(), // Sérialise les données du formulaire
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Thank You.", 'success'); // Affiche un message de succès
                    setTimeout(function() {
                        location.href = 'index.php?page=survey_widget'; // Redirige vers la page des widgets après 2 secondes
                    }, 2000);
                }
            }
        });
    });
</script>
