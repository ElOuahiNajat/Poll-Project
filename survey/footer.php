<!-- SweetAlert2 : Plugin pour des alertes stylisées -->
<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Toastr : Plugin pour afficher des notifications toast -->
<script src="assets/plugins/toastr/toastr.min.js"></script>

<!-- Select2 : Plugin pour des sélecteurs améliorés avec recherche -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>

<!-- Summernote : Éditeur WYSIWYG pour le texte -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

<script>
	$(document).ready(function(){
	  // Code commenté pour un sélecteur de date/heure, peut être réactivé si nécessaire
	  // $('.datetimepicker').datetimepicker({
	  //     format:'Y/m/d H:i',
	  //     startDate: '+3d'
	  // })

	  // Initialise Select2 pour les éléments avec la classe 'select2'
	  $('.select2').select2({
	    placeholder:"Please select here", // Texte par défaut dans la liste déroulante
	    width: "100%" // Largeur de l'élément Select2
	  });
  })
  
  // Fonction pour afficher un préchargeur de page
  window.start_load = function(){
    $('body').prepend('<div id="preloader2"></div>') // Ajoute le préchargeur au début du corps du document
  }

  // Fonction pour cacher et supprimer le préchargeur de page
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove(); // Retire le préchargeur du DOM après disparition
      })
  }

  // Fonction pour afficher un modal pour les images ou vidéos
  window.viewer_modal = function($src = ''){
    start_load() // Affiche le préchargeur
    var t = $src.split('.') // Sépare l'URL en parties
    t = t[1] // Récupère l'extension du fichier
    if(t =='mp4'){ // Si le fichier est une vidéo
      var view = $("<video src='"+$src+"' controls autoplay></video>") // Crée un élément vidéo
    }else{ // Sinon, c'est une image
      var view = $("<img src='"+$src+"' />") // Crée un élément image
    }
    // Retire tout contenu précédent dans le modal
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view) // Ajoute le nouvel élément au modal
    $('#viewer_modal').modal({
            show:true, // Affiche le modal
            backdrop:'static', // Empêche de fermer le modal en cliquant à l'extérieur
            keyboard:false, // Désactive la fermeture avec la touche Échap
            focus:true
          })
    end_load() // Cache le préchargeur
  }

  // Fonction pour afficher un modal avec contenu AJAX
  window.uni_modal = function($title = '' , $url='',$size=""){
    start_load() // Affiche le préchargeur
    $.ajax({
        url:$url, // URL pour récupérer le contenu du modal
        error:err=>{
            console.log() // Enregistre les erreurs dans la console
            alert("An error occurred") // Affiche une alerte en cas d'erreur
        },
        success:function(resp){
            if(resp){ // Si la réponse est non vide
                $('#uni_modal .modal-title').html($title) // Définit le titre du modal
                $('#uni_modal .modal-body').html(resp) // Insère le contenu récupéré
                if($size != ''){
                    $('#uni_modal .modal-dialog').addClass($size) // Applique la classe de taille si spécifiée
                }else{
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md") // Taille par défaut
                }
                $('#uni_modal').modal({
                  show:true, // Affiche le modal
                  backdrop:'static', // Empêche de fermer le modal en cliquant à l'extérieur
                  keyboard:false, // Désactive la fermeture avec la touche Échap
                  focus:true
                })
                end_load() // Cache le préchargeur
            }
        }
    })
  }

  // Fonction pour afficher un modal de confirmation
  window._conf = function($msg='', $func='', $params = []){
    $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")") // Définit l'action à exécuter si confirmé
    $('#confirm_modal .modal-body').html($msg) // Définit le message du modal
    $('#confirm_modal').modal('show') // Affiche le modal
  }

  // Configuration de Toast pour afficher des notifications toast
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000 // Durée d'affichage du toast
  });

  // Fonction pour afficher une toast notification
  window.alert_toast= function($msg = 'TEST', $bg = 'success'){
    // Code commenté pour la gestion des classes de toast
    // console.log('TEST')
    Toast.fire({
      icon: $bg, // Icône du toast (ex: success, error)
      title: $msg // Message du toast
    })
  }

  // Initialisation de Summernote pour les éditeurs de texte avec la classe 'summernote'
  $(function () {
    $('.summernote').summernote({
        height: 300, // Hauteur de l'éditeur
        toolbar: [ // Configuration de la barre d'outils
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })
  })
</script>

<!-- Inclus les scripts nécessaires pour Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars : Plugin pour améliorer les barres de défilement -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App : JavaScript pour le thème AdminLTE -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael : Plugin pour les cartes interactives -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- ChartJS : Plugin pour les graphiques -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE pour les démos -->
<script src="assets/dist/js/demo.js"></script>

<!-- AdminLTE dashboard demo (uniquement à des fins de démonstration) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>

<!-- DataTables et plugins associés pour les tableaux interactifs -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
