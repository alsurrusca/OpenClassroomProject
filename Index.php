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
        <?php
            if (isset($_POST['Login'])&& isset($_POST['Password'])){
                
            }else {
                
            }

        ?>
    <form method="post" action="Index.php">
    
    
     <label for="Login"> Login : </label> 
     <input type="text" name="Login" id="Login"/> </p>

    

    <label for="Password">Password :</label> 
    <input type="password" name="Password" id="Password"/></p>
  
</form>
<p>
    <input type="submit" value="Envoyer" />
</p>
</body>
</html>