<?php
include 'connectbdd.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT id, NOM, PRENOM FROM crud WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Utilisateur non trouvé";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $sql = "UPDATE crud SET NOM='$nom', PRENOM='$prenom' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: showUser.php"); // Redirige vers la page principale après la modification
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

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
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $row['NOM']; ?>"><br>
        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $row['PRENOM']; ?>"><br>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
