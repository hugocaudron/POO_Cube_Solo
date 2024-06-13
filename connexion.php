<?php  
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=adminconnexioncube;charset=utf8;','root', '');  //connexion à la base de donnée
if(isset($_POST['Valider'])){   
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){   //vérifie que c'est pas vide
        $pseudo = htmlspecialchars($_POST['pseudo']);   //convertit les charactères spéciaux en entités html 
        $mdp = sha1($_POST['mdp']);  //cripte le mot de passe 

        $recupUser = $bdd->prepare('SELECT * FROM user WHERE pseudo = ? AND mdp = ? ');    //sélectionne l'utilisateur dont le mot de passe correspond à ce fournie
        $recupUser->execute(array($pseudo, $mdp));  //execute la requête 

        if($recupUser->rowCount() > 0){   //vérifie si l'utilisateur existe
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: http://localhost/POO_Cube_Solo/showUser.php/');       //si ça existe l'utilisateur est redirigé vers cette page   
        }else {
            echo "Votre mot de passe ou pseudo est incorrect";
        }
    }else{
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