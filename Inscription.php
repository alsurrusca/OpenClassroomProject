<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Inscription.css" />
        <title>GBAF - Inscription</title>
       
    </head>

    <body>
        <header><img src="Images/Logo_GBAF.jpg" alt="Logo GBAF" id="Logo" /></header>
      <p>
          Inscription
      <br/>

<form method="post" action="Username.php">
    <fieldset>
        <legend>Vos coordonnées</legend>
    
    
     <label for="Nom"> Nom : </label> 
     <input type="text" name="Nom" id="Nom" required/> </p>

    

<label for="Prenom">Prénom :</label> 
<input type="text" name="Prenom" id="Prenom" required/></p>

<label for="Username">Username :</label>
<input type="text" name="Username" id="Username" required/></p>

<label for="Password"> Password :</label>
<input type="Password" name="Password" id="Password" required/></p>

    </fieldset>
<fieldset>
    <legend> Question secrète : </legend>
    <p>
        <label for="Question">Choississez votre question secrète :</label>
        <select name="Question" id="Question" required>
            <option value="1">Où habitiez vous quand vous étiez petit ?</option>
            <option value="2">Le nom de jeune fille de votre mère ?</option>
            <option value="3">Le nom de votre premier animal</option>
        </select> <br/>
        <label for="Reponse">Réponse :</label>
        <input type="text" name="Reponse" id="Reponse" required/>
    </p>
</fieldset>

<p>
        <input type="submit" value="Envoyer" />
</p>
</form>
</body>
</html>