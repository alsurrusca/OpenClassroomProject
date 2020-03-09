<!DOCTYPE html>
<html>
    <head>
<meta charset="utf-8" />
        <link rel="stylesheet" href="MonCompte.css" />
        <title>GBAF - Mon compte</title>
        </head>
<body>
<header>  <?php include("EnTete.php");?> </header>
<?php  if(isset($_SESSION['username']))
{
    ?>
<hr>

    <h2> Modification du Compte de <?php echo "".$_SESSION['nom']." ".$_SESSION['prenom'].""; ?> </h2>
    <p>
    <div id=compte name=compte>
<form method="POST" action="ModificationCompte.php">

  
            <legend>Information du compte : <br /> <br /></legend>
        
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
</div>
<?php
}
         else {
       header('Location:Index.php');
      
   }

?>


</body>
<footer> <?php include("Footer.php") ?> </footer>
</html>