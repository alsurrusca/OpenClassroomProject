<?php

session_start();


?>

<div id="logo" class="logo">
        <a href="Page1.php">
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
                            echo 'Bonjour ' . $donnees["nom"] .'  '.  $donnees["prenom"] .'<br/>' ;
            }
          
            echo $donnees["id_user"];
        ?>
        </div>
<br/>


<a href="ModificationCompte.php">
    <div id="BoutonCompte">
    <input type="submit" value ="Mon compte"></p> </a>

<a href="Deconnexion.php">
    <div id="BoutonDeco" class="BoutonDeco"> 
    <input type="submit" value = "Déconnexion"> </p> </a>  

<a href="Ajout_acteur.php">
    <div id="BoutonAjout" class="BoutonAjout">
    <input type="submit" value="Ajouter un Acteur" > </a>

    </header>
    
    <br  /> <br/> <br/>
         