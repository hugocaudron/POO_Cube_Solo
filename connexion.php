<?php  
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=adminconnexioncube;charset=utf8;', 'root', '');  // Connexion à la base de données

if (isset($_POST['Valider'])) {   
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {   // Vérifie que ce n'est pas vide
        $pseudo = htmlspecialchars($_POST['pseudo']);   // Convertit les caractères spéciaux en entités HTML 
        $mdp = sha1($_POST['mdp']);  // Hash le mot de passe 

        $recupUser = $bdd->prepare('SELECT * FROM user WHERE pseudo = ? AND mdp = ?');    // Sélectionne l'utilisateur dont le mot de passe correspond à celui fourni
        $recupUser->execute(array($pseudo, $mdp));  // Exécute la requête 

        if ($recupUser->rowCount() > 0) {   // Vérifie si l'utilisateur existe
            $user = $recupUser->fetch(); // Récupère les données de l'utilisateur
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['Admin'] = $user['Admin'];

            if ($user['Admin'] == 'Administrateur') {
                header('Location: /POO_Cube_Solo/showUser.php');
            } else {
                header('Location: /POO_Cube_Solo/User.php');
            }
            exit();
        } else {
            echo "Votre mot de passe ou pseudo est incorrect";
        }
    } else {
        echo "Veuillez compléter tous les champs";
    }
}

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8">
    </head>
        <body>

            <form method="POST" actions="" align="center">
                <input type="text" name="pseudo">
                <br>
                <input type="password" name="mdp">
                <br><br>
                <input type="submit" name="Valider" value="Connexion">
            </form>

</body>
</html>