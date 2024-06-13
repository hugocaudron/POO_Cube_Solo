<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminconnexioncube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $NOM = $_POST['NOM'];
  $PRENOM = $_POST['PRENOM'];
  
  $sql = "INSERT INTO crud (NOM, PRENOM) VALUES ('$NOM', '$PRENOM')";
  
  if ($conn->query($sql) === TRUE) {
    echo "Nouvelles personne ajouté !";
    header('Location: http://localhost/CesiCubeSolo/showUser.php/');       

  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

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


