

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="PageActeurIndex.css" />
        <title>GBAF - Présentation</title>
       
    </head>

    <body>
    <?php 
   
        ?>
         <header> <?php include("EnTete.php");?></header>
         
        
   

<hr>
 
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


<div id=tableau class=tableau>
<table class="table table-bordered">




<?php

$acteurs = $bdd->query('SELECT * FROM `acteur`');

while ($a = $acteurs->fetch()) 
{
    ?> 

<tr colspan="3">
        

    

<p><td colspan="2">
    
        <div id=logoActeur class="logoActeur"></div>
        <? echo $a['logo'];?>
        <img src="Images/<?php echo $a['logo']; ?>" alt="Logo Acteur" title="" width="100px"/> </td>

    

   
         <td><div id="acteur" class="acteur"> </div>
         <h3> <?php echo $a['acteur'];?> : </h3>  </td>
        
       <td> <div id="description" class="description" ></div>
       <br/><br/>
        <?php $description = $a['description']; // création d'une variable qui contient la description 
        $description_acteur = explode('{{{{DELIMITER}}}}', wordwrap($description, 250, '{{{{DELIMITER}}}}')); //délimitation des caractères (150)
        echo $description_acteur[0]; // on affiche la description?> 
       
        ... <br/> <br/>
        
        <div id="BoutonSuite"></div>
         <a href="PageActeur.php?id=<?= $a['id_acteur']?>">
        <input class="BoutonSuite" type="submit" value ="Lire la suite" name = "BoutonSuite"> </a> <br/> 

</p>
  
    </td>
  
</tr>


    <?php
}


?>
</hr>

</table>

<footer>
    <?php include("Footer.php");
    
?>

</body>

</html>