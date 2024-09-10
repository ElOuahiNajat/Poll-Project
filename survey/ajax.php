<?php
// Commence la mise en tampon de sortie
ob_start();

// Récupère l'action demandée depuis l'URL
$action = $_GET['action'];

// Inclut la classe Action depuis 'admin_class.php'
include 'admin_class.php';

// Crée une instance de la classe Action
$crud = new Action();

// Si l'action est 'login', appelle la méthode login() et affiche le résultat
if($action == 'login'){
	$login = $crud->login(); 
	if($login)
		echo $login;
}

// Si l'action est 'logout', appelle la méthode logout() et affiche le résultat
if($action == 'logout'){
	$logout = $crud->logout(); 
	if($logout)
		echo $logout;
}

// Si l'action est 'save_user', appelle la méthode save_user() et affiche le résultat
if($action == 'save_user'){
	$save = $crud->save_user(); 
	if($save)
		echo $save;
}

// Si l'action est 'save_page_img', appelle la méthode save_page_img() et affiche le résultat
if($action == 'save_page_img'){
	$save = $crud->save_page_img(); 
	if($save)
		echo $save;
}

// Si l'action est 'delete_user', appelle la méthode delete_user() et affiche le résultat
if($action == 'delete_user'){
	$save = $crud->delete_user(); 
	if($save)
		echo $save;
}

// Si l'action est 'save_survey', appelle la méthode save_survey() et affiche le résultat
if($action == "save_survey"){
	$save = $crud->save_survey(); 
	if($save)
		echo $save;
}

// Si l'action est 'delete_survey', appelle la méthode delete_survey() et affiche le résultat
if($action == "delete_survey"){
	$delete = $crud->delete_survey(); 
	if($delete)
		echo $delete;
}

// Si l'action est 'save_question', appelle la méthode save_question() et affiche le résultat
if($action == "save_question"){
	$save = $crud->save_question(); 
	if($save)
		echo $save;
}

// Si l'action est 'delete_question', appelle la méthode delete_question() et affiche le résultat
if($action == "delete_question"){
	$delsete = $crud->delete_question(); 
	if($delsete)
		echo $delsete;
}

// Si l'action est 'action_update_qsort', appelle la méthode action_update_qsort() et affiche le résultat
if($action == "action_update_qsort"){
	$save = $crud->action_update_qsort(); 
	if($save)
		echo $save;
}

// Si l'action est 'save_answer', appelle la méthode save_answer() et affiche le résultat
if($action == "save_answer"){
	$save = $crud->save_answer(); 
	if($save)
		echo $save;
}

// Si l'action est 'update_user', appelle la méthode update_user() et affiche le résultat
if($action == "update_user"){
	$save = $crud->update_user(); 
	if($save)
		echo $save;
}

// Termine la mise en tampon de sortie et envoie le contenu
ob_end_flush();
?>
