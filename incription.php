<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=adminconnexioncube;charset=utf8;', 'root', '');   //connexion à la base de donnée
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){   //vérifie que c'est pas vide
        $pseudo = htmlspecialchars($_POST['pseudo']);  //convertie en entités html
        $mdp = sha1($_POST['mdp']);   //cripte le mot de passe
        $insertUser = $bdd->prepare('INSERT INTO user(pseudo, mdp)VALUES(?, ?)');   //insère le mot de passe et le pseudo
        $insertUser->execute(array($pseudo, $mdp));  //execute la requête

        $recupUser = $bdd->prepare('SELECT * FROM user WHERE pseudo = ? AND mdp= ?');  
        $recupUser->execute(array($pseudo, $mdp));
        if($recupUser->rowCount() > 0){
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: http://localhost/POO_Cube_Solo/connexion.php/');       

        }
    }else{
        echo "Veuillez compléter tout les champs";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8">
    </head>
<body>

    <form method="POST" action="" align="center">

        <input type="text" name="pseudo">
        <br/>
        <input type="password" name="mdp">

        <br/><br/>

        <input type="submit" name="envoi" value="s'inscrire">
    </form>
</body>
</html>

