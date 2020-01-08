<?php

if(isset($_POST['nom_acteur'], $_POST['description_acteur'], $_POST['logo']))
{

    
    if(!empty($_POST['nom_acteur']) AND !empty($_POST['description_acteur']))
    {
        $nom_acteur= htmlspecialchars($_POST['nom_acteur']);
        $description_acteur= htmlspecialchars($_POST['description_acteur']);
        $logo=($_POST['logo']);
    
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root','');
        }
        catch (Exception $e)
        {
        die('Erreur :' . $e->getMessage());
        }   


    $ins = $bdd->prepare('INSERT INTO acteur (acteur, description, logo) VALUES (:nom_acteur, :description_acteur, :logo)');
    $ins->execute(array(
        'nom_acteur' => $nom_acteur,
        'description_acteur'=> $description_acteur,
        'logo'=> $logo
    ));
    
    $message= 'Vous avez bien ajouté un partenaire.';
    }
    else{
        $message = 'Veuillez remplir tous les champs';
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajout d'acteur</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="POST">
        <input type="text" name="nom_acteur" placeholder="Nom du Partenaire"/> <require> <br/> <br/>
        <textarea name="description_acteur" placeholder="Description"></textarea> <require> <br/>
        <input type="file" name="logo"> <br/><br/>
        <input type="submit" value="Envoyer l'article"/>
    </form>
    <br/>
    <?php if(isset($message)){ echo $message;} ?>

</body>
</html>