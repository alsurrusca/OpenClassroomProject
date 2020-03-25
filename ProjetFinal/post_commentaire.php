
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="CSS/commentaire.css" />
        <title>GBAF - Poster un commentaire</title>
</head>
        

    <body>

<header> <?php include("entete.php");?> </header>   

<hr>

<?php

$sessionusername = $_SESSION['username'];
$iduser = $_SESSION['id_user'];
$sessionprenom = $_SESSION['prenom'];
$getid = (int) $_GET['id'];
$date = date ("d-m-Y");


?>

<?php
//Voir si tout est rempli 

if(isset($_POST['submit_commentaire'])) 
{
    if (isset($_POST['Commentaire']) AND !empty ($_POST['Commentaire']))
    {
        
        //Requête pour insérer les commentaires
        $commentaire= $_POST['Commentaire'];
        $req = "INSERT INTO post (id_user, id_acteur, post, date_add) VALUES (:id_user, :id,:commentaire, Now())";
        $Nouveau_Commentaire = $bdd ->prepare($req);
        $Nouveau_Commentaire -> execute(array(
            'id_user' => $iduser,
            'id' => $getid,
            'commentaire' => $commentaire));

    $validation= "Votre commentaire à bien été enregistré." 
    ?>
    
    <!-- Redirection vers la page d'accueil si le commentaire a bien été enregistré-->
    <meta http-equiv="refresh" content="3; url=pageacteur.php?id=<?= $getid?>"> 
<?php
}

else 
{
    $erreur = "Tous les champs doivent être remplis";
}
}
?>

<div id=nouveaucommentaire name=nouveaucommentaire>
<form method="POST">
<!-- affichage automatique nom et prénom + la date -->
<p> Nom :  <?php echo "$sessionprenom  " ; ?> &nbsp;   Date : <?php echo "$date" ?> </p>
    
    <label> Nouveau commentaire : <br /> <br /> </label>
    
    <textarea name="Commentaire" placeholder="Votre commentaire..."></textarea><br /><br />
    
    <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>  

<?php 
//Affichage des différents messages
if (isset($validation)) { echo $validation;}
if(isset($erreur)) { echo $erreur;} ?>
</div>

<footer><?php include("footer.php");?></footer>
</body>
</html>

