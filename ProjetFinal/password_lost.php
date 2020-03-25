<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="CSS/password_lost.css" />
        <title>GBAF - Mot de Passe Oublié</title>
    </head>

    <header>
                <div id="logo" class="logo">
                     <img class="logo" src="Images/Logo.png" alt="Logo GBAF" id="logo" />
                 </div>
    </header>
<body>
    <div class="Formulaire" id="Formulaire">
                <h3> Mot de passe perdu - Saisissez votre nom d'utilisateur.</h3>
                <br/>

              
                    <form method="post" action="password_lost.php">
                        <p>
                            <br/>
                    <div id="username" class="username">
                            <label for="username"><strong> Username : </strong> </label> 
                            <input type="text" name="username" id="username" required/> </p>
                
</div>
                           

                <div id="question" class="question">
                    
                     <p> <strong> <label for="question">Choisissez votre question secrète :</label></strong></p>
                     
                     
            <p>
                
                <select name="question" id="question" required>
                    <option value="1">Où habitiez vous quand vous étiez petit ?</option>
                    <option value="2">Le nom de jeune fille de votre mère ?</option>
                    <option value="3">Le nom de votre premier animal</option>
            
                </select> </p>
            <p>
              <label for="reponse">Réponse :</label>
              <input type="text" name="reponse" id="reponse" required/>
            </p>
</div>
            <p> <div id="bouton"> 
              
                <input type="submit" value = "Envoyer"> </p>
                        
                 </form>
</div>


<div id="BoutonRetour" class="BoutonRetour">
<a href="index.php"><a>
    
</div>
<?php


//On vérifie que les variables username, question et reponse sont définies.

if (isset ($_POST['username']) && isset($_POST['question']) && isset($_POST['reponse']))
{



//On simplifie les noms de la variable

$username = $_POST['username'];
$question = $_POST['question'];
$reponsemdp = $_POST['reponse'];
$_SESSION['username'] = $_POST['username'];


//On appelle la base de donnée et si pb, affichage messag d'erreur
try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root',''); //appeler la base de donnée
                }
                catch (Exception $e) //si une erreur, au lieu d'afficher la ligne qui pose l'erreur (et risquer d'afficher des informations importantes) affiche un message d'erreur
                {
                die('Erreur :' . $e->getMessage());
                }

// On crée une variable réponse qui selectionne le contenu des colones username, mail, question secrète, réponse de la table account

$reponse =$bdd ->query('SELECT username, question, reponse FROM account');

// On crée les variables pour comparer les usernames, mail, question et réponse.

$comparaison_username = false;
$comparaison_question = false;
$comparaison_reponsemdp = false;

// On crée une variable donnée,
//Tant que la variable de réponse renvoie à une entrée  du username, mail, question, réponse, on continue

while (($donnees = $reponse -> fetch()) && ($comparaison_username==false) && ($comparaison_question==false) && ($comparaison_reponsemdp == false))

{
//si le username renvoie à une donnée alors on regarde le mail etc...

if ( $username == $donnees['username'])
{
    $comparaison_username = true;

            if ($question == $donnees['question'])
            {
                $comparaison_question = true;

                if ($reponsemdp == $donnees['reponse'])
                {

                    $comparaison_reponsemdp = true;
                }
            }
        
}

}

if (($comparaison_username == false))
{
    echo "Username incorrect";
}

if (($comparaison_username == true) && ($comparaison_question == false))

{
    echo " La question et/ou la réponse est incorrect !";
}

if (($comparaison_username == true) && ($comparaison_question == true) && ($comparaison_reponsemdp == false))
{
    echo "La question et/ou la réponse est incorrect ";
}

if (($comparaison_username == true) && ($comparaison_question == true) && ($comparaison_reponsemdp == true))
{
    header('Location: modification_password.php');
}
}
?>


</body>
<footer>
<p id="footer">Tous droits réservés | © GBAF | V1.0 | © Surrusca Alissia </p>
</foooter>
</html>
