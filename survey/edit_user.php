<?php
// Inclut le fichier 'db_connect.php' pour établir une connexion à la base de données
include 'db_connect.php';

// Exécute une requête pour récupérer les détails du sondage avec l'ID spécifié dans l'URL
// Récupère les résultats sous forme de tableau associatif
$qry = $conn->query("SELECT * FROM survey_set WHERE id = ".$_GET['id'])->fetch_array();

// Parcourt chaque élément du tableau de résultats
foreach($qry as $k => $v){
	// Si la clé est 'title', la renomme en 'stitle'
	if($k == 'title')
		$k = 'stitle';
	// Crée une variable dynamique avec le nom de la clé et assigne la valeur correspondante
	$$k = $v;
}

// Inclut le fichier 'new_survey.php' pour afficher ou gérer le sondage
include 'new_survey.php';
?>
