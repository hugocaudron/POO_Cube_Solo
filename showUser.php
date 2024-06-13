<?php
include 'connectbdd.php'; // Inclusion du fichier de connexion à la base de données

// Vérification de la méthode de requête pour s'assurer qu'il s'agit d'une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'identifiant de l'enregistrement à supprimer
    $id = intval($_POST['id']); // Conversion de l'identifiant en entier pour éviter les injections SQL

    // Préparation de la requête SQL pour supprimer l'enregistrement
    $sql = "DELETE FROM crud WHERE id=$id";

    // Exécution de la requête et vérification de la réussite
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Fermeture de la connexion à la base de données
    $conn->close();

    // Redirection vers la page principale après la suppression
    header('Location: http://localhost/CesiCubeSolo/showUser.php'); // Correction de l'URL de redirection
    exit(); // Arrête le script après la redirection
}
?>



<?php
include 'connectbdd.php';

// Requête SQL pour récupérer les données
$sql = "SELECT id, NOM, PRENOM FROM crud";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["NOM"] . "</td>";
                    echo "<td>" . $row["PRENOM"] . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='showUser.php' style='display:inline-block;'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<input type='submit' value='Supprimer'>";
                    echo "</form>";
                    echo "<form method='get' action='/POO_Cube_Solo/modifierUser.php' style='display:inline-block;'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<input type='submit' value='Modifier'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun utilisateur trouvé</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <a href="/POO_Cube_Solo/ajouterUser.php">Ajouter un utilisateur</a>
    <a href="/POO_Cube_Solo/incription.php">Aller à la page d'inscription</a>

</body>
</html>

