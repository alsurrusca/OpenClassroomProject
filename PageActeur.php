
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="PageActeur.css" />
        <title>GBAF - Partenaires</title>
</head>
        

    <body>

<header> <?php include("EnTete.php");?> </header>   

<hr>

<?php


if (isset($_GET['id']) && !empty($_GET['id']))

{
    $get_id =htmlspecialchars($_GET['id']);
    $acteur= $bdd->query('SELECT * FROM acteur WHERE id_acteur=' .$_GET["id"]);
    

   }
   

else 

{
    die('Erreur');
}

while ($a = $acteur -> fetch())
{
    $id=$_GET['id'];
    $req="SELECT id_vote FROM vote WHERE id_acteur = ? ";
    $likes= $bdd-> prepare($req);
    $likes->execute(array($id));
    $likes =$likes->rowCount();

    $req2="SELECT id_vote FROM vote WHERE id_acteur = ? ";
    $dislikes= $bdd-> prepare($req2);
    $dislikes->execute(array($id));
    $dislikes =$dislikes->rowCount();
    ?>
    <div id=logoActeur class="logoActeur"></div>
        <? echo $a['logo'];?>
        <img src="Images/<?php echo $a['logo']; ?>" alt="Logo Acteur" title="" width="100px"/> 
    
        <div id="acteur" class="acteur"> </div>
         <h3> <?php echo $a['acteur'];?> : </h3>  </td>
        
       <td> <div id="description" class="description" ></div>
       <br/><br/>
        <?php $description = $a['description'];
        echo $a['description'];?>


<?php
    
}
?>

<hr>

<!-- Création des boutons like/dislike
Faire un fichier php externe pour que ça soit plus lisible 
like = 1 et dislike = 2-->

<a href="Action.php?t=1&id=<?= $id?>"> J'aime</a> (<?= $likes ?>) 
<br />
<a href="Action.php?t=2&id=<?= $id?>"> Je n'aime pas </a> (<?= $dislikes ?>)





<h2> Commentaires </h2>

<form method="POST">
    <input type="text" name="Nom" placeholder="Votre Nom" /><br/>
    

<?php 
$acteur -> closeCursor();

//On récupère les commentaires 

$req= "SELECT id_user, post, DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM post WHERE id_billet = .$_GET["id"]. ORDER BY date_add ";
$bdd->prepare($req);
$req-> execute();

while ($donnees = $req-> fetch()) 
{
    ?>
    <p><strong><?php echo htmlspecialchars($donnees['id_user']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>


        </body>
</html>