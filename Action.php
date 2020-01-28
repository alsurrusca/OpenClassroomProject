
<header> <?php include("EnTete.php");?>
<?php

try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8','root',''); //appeler la base de donnée
                }
                catch (Exception $e) //si une erreur, au lieu d'afficher la ligne qui pose l'erreur (et risquer d'afficher des informations importantes) affiche un message d'erreur
                {
                die('Erreur :' . $e->getMessage());
                }

// Première chose : vérifier si GET_t et Get_id existent et si elles ne sont pas vides
// Pour isset on peut séparer les variables juste avec des virgules, mais non pour !empty -> obligé de mettre "&&"
if(isset($_GET['t'], $_GET['id']) AND !empty($_GET['t']) && !empty($_GET['id']))
    {
        // Récupération de la variable getid -> ID sera obligatoirement un nombre entier, on le converti en int pour qu'il n'y ai pas d'injection
        $getid = (int) $_GET['id'];
        $gett = (int) $_GET['t'];

        $sessionusername = $_SESSION['username'];
        $iduser = $donnees['id_user'];
        echo $iduser;
        echo "coucou";
        //voir si l'article existe
        $req = "SELECT id_acteur FROM acteur WHERE id_acteur=" . $getid . "";
        $check = $bdd-> prepare ($req);
        $check ->execute(array($getid));

        //si l'article existe bien. 
        // rowCount sert à récupérer le nombre de champs qu'il y a après la requête, ça ne doit pas retourner plus de 1 car pas d'article dupliqué
        if($check->rowCount() == 1) 
            {
               if($gett == 1) 
               {
                   //Pour que la personne ne vote qu'une seule fois 
                   $req = "SELECT * FROM vote WHERE id_acteur=" . $getid . " AND id_user=" . $sessionusername . "" ;
                   //$check_likes =$bdd->prepare('SELECT * FROM vote WHERE id_acteur= ? AND id_user=?');
                   $check_likes =$bdd->prepare($req);
                   //$check_likes-> execute(array($getid,$sessionusername));
                   //$check_likes-> execute();
                   $resultat = $check_likes-> execute();
                   
                   // enlever la ligne d'avant et mettre $resultat = $check_likes -> execute();
                   // echo $resultaµt
                   //Retourne bien la requete
                    
                   if($check_likes->rowCount() == 1)
                   {
                    $req2 = "DELETE FROM vote WHERE id_acteur=" . $getid . " AND id_user=" . $sessionusername . "";
                    $del =$bdd->prepare($req2);
                    $del-> execute();
                  
                    
                   }
                     
                       else 
                       {
                        $req3 = "INSERT INTO vote (id_ acteur, id_user, vote) VALUES (" .$getid.", ".$sessionusername.", ".$gett.")";
                        $ins=$bdd->prepare($req3);
                        $ins->execute();
                        
                    }
                   
                   
                   
                   
               }
               elseif($gett == 2)
               {
                    //Pour que la personne ne vote qu'une seule fois 
                    $req4 = "SELECT * FROM vote WHERE id_acteur=" .$getid." AND id_user=".$sessionusername."";
                    $check_dislikes=$bdd->prepare($req4);
                    $check_dislikes-> execute();
                     
                    if($check_dislikes->rowCount() == 0)
                    {
                    $req5="DELETE FROM vote WHERE id_acteur=".$getid." AND id_user=".$sessionusername."";
                     $del =$bdd->prepare($req5);
                     $del-> execute();
                    }
                      
                        else 
                        {
                        $req6="INSERT INTO vote (id_ acteur, id_user, vote) VALUES (" .$getid.", ".$sessionusername.", ".$gett.")";
                         $ins=$bdd->prepare($req6);
                         $ins->execute();
                        }
                    
               }
              //header('Location: http://localhost/Projet/PageActeur.php?id='.$getid);
            }

            else 
            {
                exit('Erreur Fatale. <a href="PageActeur.php">Revenir à l\'accueil</a>');

            }
            
    }
    