<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Inscription.css" />
        <title>GBAF - Inscription</title>
       
    </head>

    <body>
        
    <header>
        
    <img src="Images/Logo_GBAF.jpg" alt="Logo GBAF" id="Logo" />
    
    </header>
     
    <p id="nouveau">
          <img src="Images/icone_new_membres.png" alt title>
          <h2>Création d'un nouveau compte<br/></h2>
    </p>

<p>
    <form method="post" action="Inscription.php">
         <fieldset>
            <legend>Vos coordonnées</legend>
    
    
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

    </fieldset>
<fieldset>
    <legend> Question secrète : </legend>
    <p>
        <label for="question">Choisissez votre question secrète :</label>
        <select name="question" id="question" required>
            <option value="1">Où habitiez vous quand vous étiez petit ?</option>
            <option value="2">Le nom de jeune fille de votre mère ?</option>
            <option value="3">Le nom de votre premier animal</option>
            
        </select> <br/>
        <label for="reponse">Réponse :</label>
        <input type="text" name="reponse" id="reponse" required/>
    </p>
</fieldset>

<p>
        <input type="submit" value="Envoyer" />
</p>
</form>
<?php

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['username'])&& isset($_POST['mail']) && isset($_POST['password'])&&isset($_POST['question'])&& isset($_POST['reponse']))
{
   $nom=$_POST['nom'];
   $prenom=$_POST['prenom'];
   $username=$_POST['username'];
   $mail=$_POST['mail'];
   $password=$_POST['password'];
   $question=$_POST['question'];
   $reponse=$_POST['reponse'];
   
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

   $req = $bdd->prepare('INSERT INTO account(nom,prenom,username,mail,password,question,reponse) VALUES (:nom, :prenom, :username, :mail, :password, :question, :reponse)');
   $req->execute(array(
       'nom' => $nom,
       'prenom' => $prenom,
       'username' => $username,
       'mail' => $mail,
       'password' => $pass_hache,
       'question' => $question,
       'reponse' => $reponse
   ));

   


?>

Vous avez bien été enregistré, vous allez être redirigé vers la page d' accueil, ou bien <a href="Index.php"> cliquez ici !</a> <br/>
<meta http-equiv="refresh" content="3; url=Index.php">
<?php


}



else {
    
}



        ?>
</body>
<footer>
<p id="footer">Tous droits réservés | © Surrusca Alissia | V1.0 </p>
</foooter>
</html>