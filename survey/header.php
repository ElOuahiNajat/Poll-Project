<head>
  <!-- Définit le jeu de caractères pour le document -->
  <meta charset="utf-8">

  <!-- Rend le site réactif en adaptant la mise en page à la largeur de l'appareil -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php 
  ob_start(); // Démarre la temporisation de sortie
  // Définit le titre de la page en fonction du paramètre 'page' dans l'URL ou "Home" par défaut
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
  ?>
  <!-- Définit le titre de la page affichée dans l'onglet du navigateur -->
  <title><?php echo $title ?> |  PhosPoll </title>
  <?php ob_end_flush() // Libère le tampon de sortie et affiche le contenu ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons : Inclut les icônes Font Awesome pour des icônes vectorielles -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars : Styles pour améliorer les barres de défilement -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables : Styles pour les tableaux interactifs -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 : Styles pour les menus déroulants améliorés -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 : Styles pour les alertes modales stylisées -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr : Styles pour les notifications toast -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- iCheck : Styles pour les cases à cocher et boutons radio personnalisés -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style : Styles principaux du thème AdminLTE -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css"> <!-- Styles personnalisés supplémentaires -->

  <!-- Inclut jQuery, requis par de nombreux plugins JavaScript -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI : Bibliothèque JavaScript pour des widgets d'interface utilisateur -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- summernote : Styles pour l'éditeur de texte WYSIWYG Summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
</head>
