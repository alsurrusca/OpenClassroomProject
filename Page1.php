<?php
session_start();
if (empty($_SESSION['username']))
{
    header('Location:Index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Page1.css" />
        <title>GBAF - Présentation</title>
       
    </head>
    <header>
        
    <div id="logo" class="logo">
        <a href="Page1.php">
            <img class="logo" src="Images/Logo.png" alt="Logo GBAF" id="logo" />
        </a>
                 
    </div>

    <div id=log>
        <div id=nom>
        <?php 
        
        $_SESSION['username'];

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
        $reponse = $bdd->query('SELECT nom, prenom FROM account WHERE username="' .$_SESSION['username'].'"');
                        

            while($donnees = $reponse->fetch())

        

            {
                            echo 'Bonjour ' . $donnees["nom"] .'  '.  $donnees["prenom"] .'<br/>' ;
            }
            
        ?>
        </div>
<br/>


<a href="MonCompte.php">
    <div id="BoutonCompte">
    <input type="submit" value ="Mon compte"></p> </a>

<a href="Index.php">
    <div id="BoutonDeco" class="BoutonDeco"> 
    <input type="submit" value = "Déconnexion"> </p> </a>  

<a href="Ajout_acteur.php">
    <div id="BoutonAjout" class="BoutonAjout">
    <input type="submit" value="Ajouter un Acteur" > </a>



    </header>
    <br/>
<hr>
    <body>
      <h1> GBAF </h1>

    <p> 
        <strong>Le Groupement Banque Assurance Français</strong> (GBAF) est une fédération représentant les 6 grands groupes français : 
        <li>BNP Paribas
        <li> BPCE
        <li> Crédit Agricole
        <li> Crédit Mutuel - CIC 
        <li> Société Générale 
        <li> La Banque Postale 
    </p>
    <p>
    Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler
de la même façon pour gérer près de 80 millions de comptes sur le territoire
national.<br/>
La GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. 
Sa mission est de promouvoir l'activité bancaire à l'échelle nationale. C'est aussi un interlocuteur privilégié des pouvoirs publics.
<br/>
La GBAF souhaite proposer aux salariés des grands groupes français un point d'entrée unique, répertoriant un grand nombre d'informations sur les partenares et acteurs du groupe ainsi que sur les produits et services bancaires et financiers. 
        </p>

<hr>

<h2> Acteurs et Partenaires </h2>

<table class="table table-bordered">

<tr>
    <th><p class="text-error">Logo</p></th>
    <th><p class="text-error">Acteur</p></th>
    <th><p class="text-error">Description</p></th>
   
    </tr>
<tr>

<?php

$acteurs = $bdd->query('SELECT * FROM `acteur`');

while ($a = $acteurs->fetch()) 
{
    ?> 
<tr>

    <p> <td>
        <? echo $a['logo'];?>
        </td>
    <p> <td> <div class=acteur> </div>
        <?php echo $a['acteur'];?>
        </td>  
    <p> <td>
        <?php echo substr($a['description'], 0,50);?>
        </td>
    
</tr>
    <?php
}

$acteurs->closeCursor();
?>

</body>

</html>