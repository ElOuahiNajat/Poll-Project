<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
	// Démarre la session PHP pour gérer les informations de session utilisateur.
	if(!isset($_SESSION['login_id'])) // Vérifie si l'utilisateur est connecté.
	    header('location:login.php'); // Redirige vers la page de connexion s'il n'est pas connecté.
	include 'header.php'; // Inclut le fichier d'en-tête qui contient des métadonnées, des liens vers les feuilles de style et les scripts nécessaires.
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include 'topbar.php'; // Inclut la barre de navigation supérieure ?>
  <?php include 'sidebar.php'; // Inclut la barre latérale de navigation ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Toast Notifications -->
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body text-white">
        <!-- Corps du toast pour afficher des messages temporaires -->
      </div>
    </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <!-- Conteneur pour les toasts positionnés en haut à droite -->
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $title; // Affiche le titre de la page ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr style="border: none; height: 4px; background: linear-gradient(135deg, green , #ccffcc); margin: 20px 0;">

        <!-- <hr style="border: none; border-top: 3px double #32cd32; margin: 20px 0;"> -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
          // Inclut dynamiquement le contenu de la page basé sur le paramètre 'page' dans l'URL.
          $page = isset($_GET['page']) ? $_GET['page'] : 'home';
          include $page.'.php'; // Inclut le fichier PHP correspondant au nom de la page
        ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modals -->
    <!-- Modal pour confirmation -->
    <div class="modal fade" id="confirm_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
          </div>
          <div class="modal-body">
            <div id="delete_content"></div> <!-- Contenu du modal pour la confirmation -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal générique -->
    <div class="modal fade" id="uni_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5> <!-- Titre du modal -->
          </div>
          <div class="modal-body">
            <!-- Contenu du modal -->
          </div>
          <div class="modal-footer">
          <button type="button" style="background-color:#093604 ;color:aliceblue" class="btn btn-green" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal latéral -->
    <div class="modal fade" id="uni_modal_right" role='dialog'>
      <div class="modal-dialog modal-full-height modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5> <!-- Titre du modal -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="fa fa-arrow-right"></span> <!-- Icône de fermeture -->
            </button>
          </div>
          <div class="modal-body">
            <!-- Contenu du modal -->
          </div>
        </div>
      </div>
    </div>

    <!-- Modal pour visualisation d'images -->
    <div class="modal fade" id="viewer_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <img src="" alt=""> <!-- Image à afficher dans le modal -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Contenu de la barre latérale de contrôle -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="http://localhost/simple-online-survey-system_0%20-%20Copie/survey/intro.php" style="color: #00A86B;">PhosPoll.com</a>.</strong>
    Tous droits réservés.
    <div class="float-right d-none d-sm-inline-block">
      <b>PhosPoll</b> <!-- Texte d'information à droite -->
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<?php include 'footer.php'; // Inclut le fichier de pied de page qui contient les scripts JavaScript nécessaires ?>
</body>
</html>
