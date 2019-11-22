<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>GBAF - Intranet</title>
       
    </head>

    <body>
        <header><img src="Images/Logo_GBAF.jpg" alt="Logo GBAF" id="Logo" /></header>
      <p>
          Indentification
      <br/>

      
    <form method="post" action="Index.php">
    
    
    <label for="username"> Username : </label> 
    <input type="text" name="username" id="username" required/> </p>

   

   <label for="password">Password :</label> 
   <input type="password" name="password" id="password" required/></p>
 


<p>
   <input type="submit" value="Envoyer" />
</p>
</form>

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

            // on écrit la boucle de comparaison (si $username = à ce qui a écrit)

            while (($donnees = $reponse->fetch()) && ($comparaison_username==false) && ($comparaison_password==false))
            {

                //tant que la réponse renvoie une entrée on continue

                if ($username == $donnees['username']) 
                {
                    $comparaison_username=true;
                    

                        if (($password == $donnees['password']))
                        {
                            $comparaison_password=true;
                        }

                }
                
            }

        if (($comparaison_username==false) && ($comparaison_password==false))
        {
            ?>

            <p>Vous n'êtes pas enregistré. Première connexion ? Inscrivez vous <a href="Inscription.php">ici</a> <p>
        <?php
        }
        
        

        if(($comparaison_username==false)) 
        {
            echo 'Login incorrect';
        }


        if (($comparaison_username==true) && ($comparaison_password==false))
        {
            echo 'Mot de passe incorrect <br/> 
            Si vous avez oubliez votre mot de passe, cliquer ici';
        }


    }
        ?>

    
</body>
</html>