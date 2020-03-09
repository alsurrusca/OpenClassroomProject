<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="index.css" />
        <title>GBAF - Identification</title>
        

    </head>

    <header>
                <div id="logo" class="logo">
                     <img class="logo" src="Images/Logo.png" alt="Logo GBAF" id="logo" />
                 </div>

                <h2> GBAF - Intranet</h2>
            <hr>
            </header>

    <body>
        
<div id="Login" name="Login" class="Login">
    
        <h1 class="titre-id">Indentification</h1>
      <br/>


    <form method="post" action="Index.php">
    
    
    <label for="username"> Username : </label> 
    <input type="text" name="username" id="username" required/> </p>

   

   <label for="password">Password :</label> 
   <input type="password" name="password" id="password" required/></p>
 


<div>
<p>
   <input type="submit" value="Envoyer" />
   
</p>
</div>
<p>
<div class="nouveau"> 
<a href="Inscription.php" title= "1ère visite ?">Première visite ?</a><br/>
<div class="mdp">
<a href="password_lost.php" class="pw" title="Cliquez ici si vous avez oublié votre mot de passe !">Mot de passe oublié</a>
</p>
</form>
</div>


        <?php

            if (isset($_POST['username'])&& isset($_POST['password']))
            { 
                // Si username et password sont définies et différentes de NULL 
                $username=$_POST['username']; // Pour éviter de retaper $_POST pour traiter la variable
                $password=$_POST['password']; // Pour le cryptage

                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root',''); //appeler la base de donnée
                }
                catch (Exception $e) //si une erreur, au lieu d'afficher la ligne qui pose l'erreur (et risquer d'afficher des informations importantes) affiche un message d'erreur
                {
                die('Erreur :' . $e->getMessage());
                }
            
                // on récupère  le contenu de la colonne username de la table account
                //on crée une variable qui va récupérer la réponse de la requête, du coup != du nom de la variable username
            $reponse =$bdd ->query('SELECT username, password FROM account');
            
            // on créer une variable pour savoir si le username écrit par l'utilisateur = à un username de la base

            $comparaison_username=false;
            $comparaison_password=false;
           
            
            // on écrit la boucle de comparaison (si $username = à ce qui a écrit), tant que la variable renvoie quelque chose on continue.
            // Tant que la $reponse renvoie une entree, que le login != et password != alors on continue.

            while (($donnees = $reponse->fetch()) && ($comparaison_username==false) && ($comparaison_password==false))
            {
                // si le username est égal à la donnée envoyé username alors on regarde pour le mot de passe. 
                if ($username == $donnees['username']) 
                {
                    $comparaison_username=true;
                    

                        if (password_verify($password, $donnees['password']))
                        {
                            $comparaison_password=true;
                        }

                }
                
            }
        // Si tout est faux, phrase de connexion
        if (($comparaison_username==false) && ($comparaison_password==false)) 
        {
            ?>

            <p>Vous n'êtes pas enregistré. Première connexion ? Inscrivez vous <a href="Inscription.php">ici</a> <p>
        <?php
        }
        // Si le username est bon mais pas le password on renvoie à l'oublie de mdp
       

        if (($comparaison_username==true)  && ($comparaison_password==false) )
        {
            ?>
            <p> Mot de passe incorrect <br/>
            <a href="Password_lost.php" title= "Mot de passe oublié">Mot de passe oublié </a> </p>

            <?php
        }

        //Si le username et le mdp est bon, alors on est redirigé vers la page accueil.php
        if (($comparaison_username==true)  && ($comparaison_password==true))
        {
            $_SESSION['username']=$_POST['username'];
            header('Location: PageActeurIndex.php');
            //header('Location: entete.php');
        }

        

        


    }
        ?>

<?php include("Footer.php");?>
</body>


</html>