<?php
// Démarrage de la session pour gérer les variables de session
session_start();
// Activation de l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);

// Déclaration de la classe Action
Class Action {
	private $db; // Déclaration de la propriété pour la connexion à la base de données

	// Constructeur de la classe, appelé lors de l'instanciation de l'objet
	public function __construct() {
		ob_start(); // Démarrage de la mise en tampon de sortie pour capturer les sorties
		include 'db_connect.php'; // Inclusion du fichier de connexion à la base de données
		$this->db = $conn; // Initialisation de la propriété $db avec l'objet de connexion
	}

	// Destructeur de la classe, appelé lorsque l'objet est détruit
	function __destruct() {
	    $this->db->close(); // Fermeture de la connexion à la base de données
	    ob_end_flush(); // Vidage du tampon de sortie et affichage du contenu
	}

	// Fonction de connexion de l'utilisateur
	function login(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Requête pour vérifier si l'utilisateur existe avec l'email et le mot de passe fournis
		$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){ // Vérification si l'utilisateur a été trouvé
			// Stockage des informations utilisateur dans la session
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1; // Retourne 1 si la connexion est réussie
		}else{
			return 3; // Retourne 3 si la connexion échoue
		}
	}

	// Fonction de déconnexion de l'utilisateur
	function logout(){
		session_destroy(); // Destruction de toutes les variables de session
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]); // Suppression individuelle des variables de session
		}
		// Redirection vers la page de connexion
		header("location:login.php");
	}

	// Fonction pour enregistrer un utilisateur
	function save_user(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		$data = ""; // Initialisation de la variable $data pour stocker les champs SQL
		// Boucle à travers les données POST pour construire la requête SQL
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){ // Exclusion de certains champs
				if($k =='password')
					$v = md5($v); // Hachage du mot de passe
				if(empty($data)){
					$data .= " $k='$v' "; // Ajout du premier champ
				}else{
					$data .= ", $k='$v' "; // Ajout des champs suivants
				}
			}
		}
		// Vérification si un utilisateur avec le même email existe déjà
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2; // Retourne 2 si l'email existe déjà
			exit;
		}
		// Insertion ou mise à jour de l'utilisateur dans la base de données
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1; // Retourne 1 si l'enregistrement ou la mise à jour a réussi
		}
	}

	// Fonction pour mettre à jour les informations utilisateur
	function update_user(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		$data = ""; // Initialisation de la variable $data pour stocker les champs SQL
		// Boucle à travers les données POST pour construire la requête SQL
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){ // Exclusion de certains champs
				if($k =='password')
					$v = md5($v); // Hachage du mot de passe
				if(empty($data)){
					$data .= " $k='$v' "; // Ajout du premier champ
				}else{
					$data .= ", $k='$v' "; // Ajout des champs suivants
				}
			}
		}
		// Vérification si un utilisateur avec le même email existe déjà
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2; // Retourne 2 si l'email existe déjà
			exit;
		}
		// Insertion ou mise à jour de l'utilisateur dans la base de données
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			// Mise à jour des informations utilisateur dans la session
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1; // Retourne 1 si la mise à jour a réussi
		}
	}

	// Fonction pour supprimer un utilisateur
	function delete_user(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Exécution de la requête de suppression
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1; // Retourne 1 si la suppression a réussi
	}

	// Fonction pour enregistrer une image de page
	function save_page_img(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Vérification si un fichier a été téléchargé
		if($_FILES['img']['tmp_name'] != ''){
			// Construction d'un nom de fichier unique basé sur le timestamp actuel
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			// Déplacement du fichier téléchargé vers le répertoire de destination
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			if($move){
				// Construction de l'URL complète de l'image téléchargée
				$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
				$hostName = $_SERVER['HTTP_HOST'];
				$path = explode('/', $_SERVER['PHP_SELF']);
				$currentPath = '/'.$path[1];
				// Retourne le chemin de l'image sous forme de JSON
				return json_encode(array('link'=>$protocol.'://'.$hostName.$currentPath.'/admin/assets/uploads/'.$fname));
			}
		}
	}

	// Fonction pour enregistrer un sondage
	function save_survey(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		$data = ""; // Initialisation de la variable $data pour stocker les champs SQL
		// Boucle à travers les données POST pour construire la requête SQL
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){ // Exclusion de certains champs
				if(empty($data)){
					$data .= " $k='$v' "; // Ajout du premier champ
				}else{
					$data .= ", $k='$v' "; // Ajout des champs suivants
				}
			}
		}
		// Insertion ou mise à jour du sondage dans la base de données
		if(empty($id)){
			$save = $this->db->query("INSERT INTO survey_set set $data");
		}else{
			$save = $this->db->query("UPDATE survey_set set $data where id = $id");
		}

		if($save)
			return 1; // Retourne 1 si l'enregistrement ou la mise à jour a réussi
	}

	// Fonction pour supprimer un sondage
	function delete_survey(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Exécution de la requête de suppression
		$delete = $this->db->query("DELETE FROM survey_set where id = ".$id);
		if($delete){
			return 1; // Retourne 1 si la suppression a réussi
		}
	}

	// Fonction pour enregistrer une question de sondage
	function save_question(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		$data = " survey_id=$sid "; // Initialisation de la variable $data avec l'ID du sondage
		$data .= ", question='$question' "; // Ajout du texte de la question
		$data .= ", type='$type' "; // Ajout du type de question
		if($type != 'textfield_s'){ // Si le type de question n'est pas un champ de texte simple
			$arr = array(); // Initialisation d'un tableau pour stocker les options de réponse
			foreach ($label as $k => $v) {
				$i = 0 ;
				while($i == 0){
					$k = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5); // Génération d'une clé unique pour l'option
					if(!isset($arr[$k]))
						$i = 1;
				}
				$arr[$k] = $v; // Stockage de l'option de réponse dans le tableau
			}
			$data .= ", frm_option='".json_encode($arr)."' "; // Conversion du tableau d'options en JSON
		}else{
			$data .= ", frm_option='' "; // Aucune option pour un champ de texte simple
		}
		// Insertion ou mise à jour de la question dans la base de données
		if(empty($id)){
			$save = $this->db->query("INSERT INTO questions set $data");
		}else{
			$save = $this->db->query("UPDATE questions set $data where id = $id");
		}

		if($save)
			return 1; // Retourne 1 si l'enregistrement ou la mise à jour a réussi
	}

	// Fonction pour supprimer une question de sondage
	function delete_question(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Exécution de la requête de suppression
		$delete = $this->db->query("DELETE FROM questions where id = ".$id);
		if($delete){
			return 1; // Retourne 1 si la suppression a réussi
		}
	}

	// Fonction pour mettre à jour l'ordre des questions dans un sondage
	function action_update_qsort(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		$i = 0; // Initialisation d'un compteur pour l'ordre des questions
		// Boucle à travers les IDs des questions pour mettre à jour leur ordre
		foreach($qid as $k => $v){
			$i++;
			$update[] = $this->db->query("UPDATE questions set order_by = $i where id = $v"); // Mise à jour de l'ordre des questions
		}
		if(isset($update))
			return 1; // Retourne 1 si la mise à jour a réussi
	}

	// Fonction pour enregistrer les réponses à un sondage
	function save_answer(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Boucle à travers les IDs des questions pour enregistrer les réponses
		foreach($qid as $k => $v){
			$data = " survey_id=$survey_id "; // Initialisation de la variable $data avec l'ID du sondage
			$data .= ", question_id='$qid[$k]' "; // Ajout de l'ID de la question
			$data .= ", user_id='{$_SESSION['login_id']}' "; // Ajout de l'ID de l'utilisateur
			if($type[$k] == 'check_opt'){ // Si le type de question est une case à cocher
				$data .= ", answer='[".implode("],[",$answer[$k])."]' "; // Stockage des réponses sous forme de tableau
			}else{
				$data .= ", answer='$answer[$k]' "; // Stockage de la réponse unique
			}
			$save[] = $this->db->query("INSERT INTO answers set $data"); // Insertion de la réponse dans la base de données
		}

		if(isset($save))
			return 1; // Retourne 1 si l'enregistrement a réussi
	}

	// Fonction pour supprimer un commentaire
	function delete_comment(){
		extract($_POST); // Extraction des données POST dans des variables individuelles
		// Exécution de la requête de suppression
		$delete = $this->db->query("DELETE FROM comments where id = ".$id);
		if($delete){
			return 1; // Retourne 1 si la suppression a réussi
		}
	}
}
