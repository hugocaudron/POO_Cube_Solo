<?php
// Définition des variables contenant les informations de connexion à la base de données
$servername = "localhost"; // Nom du serveur de base de données, généralement "localhost" pour une base de données locale
$username = "root"; // Nom d'utilisateur pour se connecter à la base de données
$password = ""; // Mot de passe pour se connecter à la base de données (laisser vide si aucun mot de passe n'est défini)
$dbname = "adminconnexioncube"; // Nom de la base de données à laquelle se connecter

// Création de la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) { // Si une erreur de connexion se produit
    die("Connection failed: " . $conn->connect_error); // Affiche un message d'erreur et arrête le script
}
?>
