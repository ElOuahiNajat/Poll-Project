<?php 

// Crée une connexion à la base de données MySQL
// 'localhost' : l'adresse du serveur de base de données
// 'root' : le nom d'utilisateur pour se connecter à la base de données
// '' : le mot de passe (ici vide)
// 'survey_db' : le nom de la base de données
// Si la connexion échoue, affiche un message d'erreur
$conn = new mysqli('localhost', 'root', '', 'survey_db') or die("Could not connect to mysql" . mysqli_error($con));
?>
