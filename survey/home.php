<?php include('db_connect.php') ?>
<!-- Inclut le fichier de connexion à la base de données pour établir la connexion à MySQL -->

<!-- Affichage conditionnel en fonction du type de connexion -->
<?php if($_SESSION['login_type'] == 1): ?> 
    <!-- Si le type de connexion est 1 (probablement un administrateur) -->
    <div class="container">
        <h1 class="dashboard-title">Dashboard</h1>

        <p class="highlight-paragraph">
            Discover the key features of the Dashboard. This section provides valuable insights and data to help you track your performance and make informed decisions. Stay engaged and explore the various tools available to you.
        </p>

        <div class="row">
            <!-- Première boîte d'information : Total Members -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users-cog"></i></span>
                    <!-- Icône et couleur pour la boîte d'information -->

                    <div class="info-box-content">
                        <span class="info-box-text">Total Members</span>
                        <!-- Texte descriptif pour la boîte d'information -->
                        <span class="info-box-number">
                            <?php 
                            // Compte le nombre total d'abonnés (type = 3) et l'affiche
                            echo $conn->query("SELECT * FROM users WHERE type = 3")->num_rows; 
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            
            <!-- Deuxième boîte d'information : Total Polls -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-poll"></i></span>
                    <!-- Icône et couleur pour la boîte d'information -->

                    <div class="info-box-content">
                        <span class="info-box-text">Total Polls</span>
                        <!-- Texte descriptif pour la boîte d'information -->
                        <span class="info-box-number">
                            <?php 
                            // Compte le nombre total de sondages et l'affiche
                            echo $conn->query("SELECT * FROM survey_set")->num_rows; 
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php else: ?>
    <!-- Si le type de connexion n'est pas 1 (probablement un utilisateur) -->
    <div class="container">
        <h1 class="my-4 welcome-title">Welcome Page</h1>
        <div class="card">
            <div class="card-body">
                Welcome <?php echo htmlspecialchars($_SESSION['login_name']); ?>!
                <!-- Affiche un message de bienvenue avec le nom de l'utilisateur connecté -->
            </div>
        </div>
        
        <div class="row my-4">
            <!-- Crée une rangée pour la boîte d'informations spécifique aux utilisateurs -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-poll"></i></span>
                    <!-- Icône et couleur pour la boîte d'information -->

                    <div class="info-box-content">
                        <span class="info-box-text">Total Poll Taken</span>
                        <!-- Texte descriptif pour la boîte d'information -->
                        <span class="info-box-number">
                            <?php 
                            // Compte le nombre distinct de sondages que l'utilisateur a pris et l'affiche
                            echo $conn->query("SELECT distinct(survey_id) FROM answers WHERE user_id = {$_SESSION['login_id']}")->num_rows; 
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    
<?php endif; ?>
<!-- Fin de la condition -->

<style>
    /* Styles pour le titre du tableau de bord */
    .dashboard-title {
        font-size: 2.5em;
        font-weight: 700;
        color: #333;
        text-align: center;
        margin-top: 0;
        margin-bottom: 30px;
        padding: 15px;
        border-bottom: 3px solid #28a745;
        display: inline-block;
        background: linear-gradient(to right, #f9f9f9, #e3e3e3);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: fadeIn 2s ease-in-out;
    }

    /* Animation de fondu pour le titre */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Styles pour le titre de bienvenue */
    .welcome-title {
        font-size: 2em;
        font-weight: 600;
        color: #444;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Styles pour le paragraphe */
    .highlight-paragraph {
        background-color: #ffffff;
        border: 2px solid #26a69a;
        padding: 25px 40px 25px 60px; /* Ajuste le padding pour faire de la place pour l'icône */
        margin: 20px 0;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        font-size: 18px;
        font-style: italic;
        color: #333;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease, padding 0.3s ease;
    }

    /* Effet d'animation au survol */
    .highlight-paragraph:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.35);
    }

    .highlight-paragraph::before {
        content: '🔍';
        font-size: 28px;
        position: absolute;
        top: 20px;
        left: 20px; /* Garder une distance adéquate du texte */
        color: #26a69a; /* Couleur de l'icône */
    }

    /* Styles pour les boîtes d'information */
    .info-box {
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .info-box:hover {
        background-color: #f9f9f9;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .info-box-icon {
        border-radius: 50%;
        padding: 15px;
        font-size: 2.2em;
        color: #fff;
    }

    .info-box-content {
        margin-left: 15px;
    }

    .info-box-text {
        font-weight: bold;
        color: #333;
    }

    .info-box-number {
        font-size: 1.7em;
        color: #28a745;
    }

    /* Couleur de fond verte pour les icônes */
    .bg-success {
        background-color: #28a745 !important;
    }

    /* Styles pour les cartes */
    .card {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        margin-bottom: 20px;
    }

    /* Styles généraux pour la page */
    .row {
        margin: 0 -15px;
    }

    .col {
        padding: 0 15px;
    }
</style>
