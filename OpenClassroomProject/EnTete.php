<?php

session_start();


?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="EnTete.css" />
        <title>GBAF - Partenaires</title>
</head>
        

<div id="logo" class="logo">
        <a href="PageActeurIndex.php">
            <img class="logo" src="Images/Logo.png" alt="Logo GBAF" id="logo" />
        </a>
                 
    </div>

    <div id=log>
        <div id=nom>
        <?php 
        
        

        if(isset($_SESSION['username']));

        {
        try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root',''); //appeler la base de donnée
                }
                catch (Exception $e) //si une erreur, au lieu d'afficher la ligne qui pose l'erreur (et risquer d'afficher des informations importantes) affiche un message d'erreur
                {
                die('Erreur :' . $e->getMessage());
                }
                
            }
        $req = 'SELECT * FROM account WHERE username="' .$_SESSION['username'].'"';
        $reponse = $bdd->query($req);
                        

            while($donnees = $reponse->fetch())

        

            {
                        $_SESSION['id_user'] = $donnees["id_user"] ;    
                        $_SESSION['nom'] = $donnees['nom'];
                        $_SESSION['prenom'] = $donnees['prenom'];
                        echo 'Bonjour ' . $donnees["nom"] .'  '.  $donnees["prenom"] .'<br/>' ;
                           
                            
            }
          
            
        ?>
        </div>
<br/>


<a href="MonCompte.php">
    <div id="BoutonCompte">
    <input type="submit" value ="Mon compte"></p> </a>

<a href="Deconnexion.php">
    <div id="BoutonDeco" class="BoutonDeco"> 
    <input type="submit" value = "Déconnexion"> </p> </a>  </div>

<a href="PageActeurIndex.php">
    <div id="BoutonRetour" class="BoutonRetour">
    <input type="submit" value =" Retour"></p></a> </div>


    </header>
    
    <br  /> <br/> <br/>
         