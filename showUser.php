<?php
include 'connectbdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM crud WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    
    header('Location: http://localhost/CesiCubeSolo/showUser.php/');         
    exit();
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
                    echo "<form method='get' action='/CesiCubeSolo/modifierUser.php' style='display:inline-block;'>";
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

    <a href="/CesiCubeSolo/ajouterUser.php">Ajouter un utilisateur</a>
</body>
</html>

