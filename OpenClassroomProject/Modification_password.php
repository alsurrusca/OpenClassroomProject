<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Modification.css" />
        <title>GBAF - Modification de Mot de Passe</title>
       
    </head>
    <body>

    <p>
    <form method="post" action="Modification_password.php">
         <fieldset>
            <legend>Votre nouveau mot de passe</legend>
    
    
        <label for="remplace_MDP"> Nouveau mot de passe :</label>
        <input type="Password" name="remplace_MDP" id="remplace_MDP" required/></p>

        <label for="mdp2"> Confirmer le nouveau Mot de Passe : </label>
        <input type="Password" name="mdp2" id="mdp2" required/></p>
        </fieldset>
</p>

<p>
        <input type="submit" value="Envoyer" />
</p>
</form>

    <?php

    //vérification mdp (pas le même que l'ancien)

     $_SESSION['username'];


     if (isset($_POST['remplace_MDP']) && isset($_POST['mdp2']) && ($_POST['remplace_MDP'] == $_POST['mdp2']))
     {
        
            
    
    $remplace_MDP = password_hash($_POST['remplace_MDP'], PASSWORD_DEFAULT);
    

  
         
     

     try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root',''); //appeler la base de donnée
                }
                catch (Exception $e) //si une erreur, au lieu d'afficher la ligne qui pose l'erreur (et risquer d'afficher des informations importantes) affiche un message d'erreur
                {
                die('Erreur :' . $e->getMessage());
                }
                
               
  
       $ModificationMDP= "UPDATE account SET password='" . $remplace_MDP . "' WHERE username='" . $_SESSION['username'] . "'; ";
      
              $resultat=$bdd->prepare($ModificationMDP);
            $resultat->execute();
              
       
       if(!$resultat) 
    {
           die('Erreur SQL !'.$ModificationMDP.'<br/>'.mysql_error());

       }
       else
       {
           echo "Votre mot de passe à bien été modifié, vous allez être redirigé vers la page de connexion"; 
           ?>

           <meta http-equiv="refresh" content="3; url=Index.php">
           <?php
        }
    }


    ?>
<footer> <?php include("Footer.php");?> </footer>
        </body>
    </html>