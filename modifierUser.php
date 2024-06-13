<?php
include 'connectbdd.php'; // Inclusion du fichier de connexion à la base de données

// Vérifie si la méthode de la requête est GET et si le paramètre 'id' est présent
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Convertit l'identifiant en entier pour éviter les injections SQL
    $id = intval($_GET['id']);

    // Requête SQL pour sélectionner l'utilisateur avec l'identifiant donné
    $sql = "SELECT id, NOM, PRENOM FROM crud WHERE id=$id";
    $result = $conn->query($sql); // Exécute la requête

    // Vérifie si l'utilisateur est trouvé dans la base de données
    if ($result->num_rows > 0) {
        // Récupère les données de l'utilisateur
        $row = $result->fetch_assoc();
    } else {
        // Affiche un message si l'utilisateur n'est pas trouvé et arrête le script
        echo "Utilisateur non trouvé";
        exit();
    }
}

// Vérifie si la méthode de la requête est POST pour mettre à jour les données de l'utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Convertit l'identifiant en entier pour éviter les injections SQL
    $id = intval($_POST['id']);
    // Récupère les nouvelles valeurs des champs NOM et PRENOM
    $NOM = $_POST['NOM'];
    $PRENOM = $_POST['PRENOM'];

    // Requête SQL pour mettre à jour les données de l'utilisateur
    $sql = "UPDATE crud SET NOM='$NOM', PRENOM='$PRENOM' WHERE id=$id";

    // Vérifie si la mise à jour a réussi
    if ($conn->query($sql) === TRUE) {
        // Affiche un message de succès et redirige vers la page principale
        echo "Record updated successfully";
        header("Location: showUser.php"); // Redirection vers la page principale après la modification
        exit();
    } else {
        // Affiche un message d'erreur si la mise à jour échoue
        echo "Error updating record: " . $conn->error;
    }
}

// Ferme la connexion à la base de données
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
</head>
<body>
    <h1>Modifier Utilisateur</h1>
    <form action="modifierUser.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="NOM">Nom:</label>
        <input type="text" id="NOM" name="NOM" value="<?php echo $row['NOM']; ?>"><br>
        <label for="prenom">Prenom:</label>
        <input type="text" id="PRENOM" name="PRENOM" value="<?php echo $row['PRENOM']; ?>"><br>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
