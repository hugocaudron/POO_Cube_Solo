<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminconnexioncube";

// Création de la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Arrête le script si la connexion échoue
}

// Vérifie si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $NOM = $_POST['NOM'];
    $PRENOM = $_POST['PRENOM'];

    // Préparation de la requête SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO crud (NOM, PRENOM) VALUES (?, ?)");
    $stmt->bind_param("ss", $NOM, $PRENOM); // Liaison des paramètres

    // Exécution de la requête et vérification du succès
    if ($stmt->execute() === TRUE) {
        echo "Nouvelle personne ajoutée !";
        header('Location: http://localhost/POO_Cube_Solo/showUser.php'); // Redirection vers une autre page après l'insertion
        exit(); // Arrête le script après la redirection
    } else {
        echo "Error: " . $stmt->error; // Affiche l'erreur si l'insertion échoue
    }

    // Fermeture de la déclaration préparée
    $stmt->close();
}

// Fermeture de la connexion à la base de données
$conn->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="ajouterUser.php" method="post">
  <label for="NOM">Nom:</label>
  <input type="text" id="NOM" name="NOM"><br>
  <label for="PRENOM">Prénom:</label>
  <input type="text" id="PRENOM" name="PRENOM"><br>
  <input type="submit" value="Créer">
</form>

</body>
</html>


