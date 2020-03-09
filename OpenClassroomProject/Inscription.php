<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Inscription.css" />
        <title>GBAF - Inscription</title>
       
    </head>

    <body>
        
    <header>
        
    <img src="Images/Logo.png" alt="Logo GBAF" id="Logo" />
    
    </header>
     
    <p id="nouveau">
          
          <h2>Création d'un nouveau compte<br/></h2>
    </p>
</id>

    <div id="formulaire" name="formulaire">
<p>
    <form method="post" action="Inscription.php">
         
            <h4>Vos coordonnées</h4>
    
    
     <label for="nom"> Nom : </label> 
     <input type="text" name="nom" id="nom" required/> 
</p>

    

<label for="prenom">Prénom :</label> 
<input type="text" name="prenom" id="prenom" required/></p>

<label for="username">Username :</label>
<input type="text" name="username" id="username" required/></p>

<label for="mail">Adresse Mail :</label>
<input type="text" name="mail" id="mail" required/></p>

<label for="password"> Password :</label>
<input type="Password" name="password" id="password" required/></p>

   

    <h4> Question secrète : </h4>
    <p>
        <label for="question">Choisissez votre question secrète :</label> <br /> </p>
        <p>
        <select name="question" id="question" required>
            <option value="1">Où habitiez vous quand vous étiez petit ?</option>
            <option value="2">Le nom de jeune fille de votre mère ?</option>
            <option value="3">Le nom de votre premier animal</option>
            
        </select> <br/> <br />
        <label for="reponse">Réponse :</label>
        <input type="text" name="reponse" id="reponse" required/>
    </p>


<p>
    <div class="Bouton">
        <input type="submit" value="Envoyer" />
        
   
</div>
</p>
</form>
</id>

<div id="BoutonRetour" class="BoutonRetour">
<a href="Index.php"><a>
    
    
<?php

//Voir si tout est rempli
if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['username'])&& isset($_POST['mail']) && isset($_POST['password'])&&isset($_POST['question'])&& isset($_POST['reponse']))
{
    // On simplifie les noms de variable
   $nom=$_POST['nom'];
   $prenom=$_POST['prenom'];
   $username=$_POST['username'];
   $mail=$_POST['mail'];
   $password=$_POST['password'];
   $question=$_POST['question'];
   $reponse=$_POST['reponse'];
   
   //Connexion à la base de donnée
   try
   {
       $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root','');
   }
   catch (Exception $e)
   {
   die('Erreur :' . $e->getMessage());
   }

   //cache du mdp
   $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

//Requête pour inscrire les champs requis dans la table account
   $req = "INSERT INTO account(nom,prenom,username,mail,password,question,reponse) VALUES (".$nom.", ".$prenom.", ".$username.", ".$mail.", ".$password.", ".$question.", ".$reponse.")";
   $inscription = $bdd->prepare($req);
   $inscription->execute();

   


?>

Vous avez bien été enregistré, vous allez être redirigé vers la page d' accueil, ou bien <a href="Index.php"> cliquez ici !</a> <br/>
<!-- Pour raffraichir la page au bout de 3 seconde dans l'url Index.php-->
<meta http-equiv="refresh" content="3; url=Index.php">
<?php


}



else {
    
    
}



        ?>
</body>
<footer>
<?php include("Footer.php");?>
</foooter>
</html>