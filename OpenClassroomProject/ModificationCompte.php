
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="ModificationCompte.css" />
        <title>GBAF - Modification du Compte</title>
</head>
        

    <body>
    <?php  if(isset($_SESSION['username']))
{
    ?>
<header>  <?php include("EnTete.php");?> </header>

    <hr>


    <h2> Modification du Compte de <?php echo "".$_SESSION['nom']." ".$_SESSION['prenom'].""; ?> </h2>

<p>
<form method="POST" action="ModificationCompte.php">

  <fieldset>
            <legend>Information du compte : <br /></legend>
        
        <label for="name"> Nom de compte : <?php echo "".$_SESSION['nom']." ".$_SESSION['prenom'].""; ?> <br /> <br /> </label> 

        <label for="username"> Username : <?php echo $_SESSION['username']; ?> </br> <br /> </label>

        <label for="New_mail"> Nouveau Mail : </label>
        <input type="New_mail" name="New_mail" id="New_mail"/></p>

        
        <label for="remplace_MDP"> Nouveau mot de passe :</label>
        <input type="Password" name="remplace_MDP" id="remplace_MDP"></p>

        <label for="mdp2"> Confirmer le nouveau Mot de Passe : </label>
        <input type="Password" name="mdp2" id="mdp2" /></p>

        <label for ="New_question"> Changer la question secrète : </label>
        <select name="New_question" id="New_question" >
            <option value="1">Où habitiez vous quand vous étiez petit ?</option>
            <option value="2">Le nom de jeune fille de votre mère ?</option>
            <option value="3">Le nom de votre premier animal</option>
            
        </select> <br/> <br />
        <label for="reponse">Nouvelle Réponse :</label>
        <input type="text" name="reponse" id="reponse" /> </p>  


    <input type="submit" value="Mettre à jour le profil" />
    <?php if(isset($msg)) {echo $msg;}   ?>
         </fieldset>


<?php


//Selectionner toutes les entrées de la table account
        $req = "SELECT * FROM account WHERE username = ".$_SESSION['username']."";
        $requser = $bdd -> prepare($req);
        $requser -> execute();
        $user = $requser-> fetch();

        echo $user['mail'];


if(isset($_POST['New_mail']) AND !empty($_POST['New_mail']) AND $_POST['New_mail'] != $user['mail']) 
{
        $New_mail = htmlspecialchars($_POST['New_mail']);
        $req1 = "UPDATE account SET mail ='".$New_mail."' WHERE username = '".$_SESSION['username']."';";
        $mail = $bdd->prepare($req1);
        $mail->execute();
        
        echo "Votre mail à bien été changé.";
    
} 

if (isset($_POST['remplace_MDP']) && isset($_POST['mdp2']) AND !empty($_POST['remplace_MDP']) AND !empty($_POST['mdp2']))
{

        if ($_POST['remplace_MDP'] == $_POST['mdp2'])
     {
        echo $_POST['remplace_MDP'];
    $remplace_MDP = password_hash($_POST['remplace_MDP'], PASSWORD_DEFAULT);
    $ModificationMDP= "UPDATE account SET password='" . $remplace_MDP . "' WHERE username='" . $_SESSION['username'] . "'; ";
    $resultat=$bdd->prepare($ModificationMDP);
    $resultat->execute();
    
    echo "Votre MDP a été changé";

        } 
        else 
        {
                $msg = "Vos deux mots de passe ne correspondent pas !";
        }
        
       
}
echo "Vous allez être redirigé vers la page d'accueil!";
$delai=3;
$url='PageActeurIndex.php';
header("Refresh: $delai; url=$url");

}
else {
    header('Location : Index.php');
}

?>
<footer> <?php include ("Footer.php")?></footer>
    </body>
    </html>