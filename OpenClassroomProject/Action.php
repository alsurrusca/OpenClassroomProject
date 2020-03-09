
<header> <?php include("EnTete.php");?>
<?php
$debug = 1 ;

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
        $iduser = $_SESSION['id_user'];
        

        //voir si l'article existe
        $req = "SELECT id_acteur FROM acteur WHERE id_acteur=" . $getid . "";
        $check = $bdd-> prepare ($req);
        $res=$check ->execute();
        if ($res && $debug) echo "Article existant <br />";
        

        //si l'article existe bien. 
        // rowCount sert à récupérer le nombre de champs qu'il y a après la requête, ça ne doit pas retourner plus de 1 car pas d'article dupliqué
        if($check->rowCount() == 1) 
            {
                // Requête pour les likes
               if($gett == 1) 
               {
                   
                   //Pour que la personne ne vote qu'une seule fois 
                   $req = "SELECT id_vote FROM vote WHERE id_acteur=" . $getid . " AND id_user=" . $iduser . "" ;
                        $check_likes =$bdd->prepare($req);
                        $resultat = $check_likes-> execute();
                        if ($resultat && $debug) echo "Le user a déjà voté pour cet acteur <br />";

                        
                    //On supprime toujours le vote 
                        $req2 = "DELETE FROM vote WHERE id_acteur=" . $getid . " AND id_user=" . $iduser . " AND vote=2";
                        $del =$bdd->prepare($req2);
                        $res1=$del-> execute();
                        if($res1 && $debug) echo "On a bien enlevé l'ancien vote ! <br />";
                     
                    //Pour supprimer le vote si la personne veut changer
                   if($check_likes->rowCount() == 1)
                   {
                       echo "On a changé d'avis";
                    $req2 = "DELETE FROM vote WHERE id_acteur=" . $getid . " AND id_user=" . $iduser . " AND vote=1";
                        $del =$bdd->prepare($req2);
                        $res1=$del-> execute();
                        if($res1 && $debug) echo "On a bien enlevé l'ancien vote ! <br />";
                  
                    // Pour insérer le vote 
                    $req3 = "INSERT INTO vote (id_ acteur, id_user, vote) VALUES (" .$getid.", ".$iduser.", ".$gett.")";
                        $ins=$bdd->prepare($req3);
                        $res2=$ins->execute();
                        if($res2 && $debug) echo "On vient d'ajouter le vote !";

                   }
                   else 
                       {
                        $req4 = "INSERT INTO vote (id_acteur, id_user, vote) VALUES (" .$getid.", ".$iduser.", ".$gett.")";
                            $ins=$bdd->prepare($req4);
                            $res3=$ins->execute();
                            if($res3 && $debug) echo "On vient d'ajouter le vote !";
                    }
                   
                   
                   
                   
               }
                // Requête pour les dislikes 
               elseif($gett == 2)
               {
                    //Pour que la personne ne vote qu'une seule fois 
                    $req5 = "SELECT * FROM vote WHERE id_acteur=" .$getid." AND id_user=".$iduser."";
                        $check_dislikes=$bdd->prepare($req5);
                        $res4= $check_dislikes-> execute();
                        if($res4) echo "Le user a déjà voté pour cet acteur <br />";

                        $req6="DELETE FROM vote WHERE id_acteur=".$getid." AND id_user=".$iduser." AND vote =1";
                        $del1 =$bdd->prepare($req6);
                        $res5= $del1-> execute();
                        if($res5 && $debug) echo "On a bien enlevé l'ancien vote ! <br />";
                    
                     
                    //Si la personne change d'avis. Si il y a déjà un like sur la ligne alors il va s'enlever
                    if($check_dislikes->rowCount() == 1)
                    {
                        
                    $req6="DELETE FROM vote WHERE id_acteur=".$getid." AND id_user=".$iduser." AND vote =2";
                        $del1 =$bdd->prepare($req6);
                        $res5= $del1-> execute();
                        if($res5 && $debug) echo "On a bien enlevé l'ancien vote ! <br />";

                    //Pour inserer le vote
                     $req7="INSERT INTO vote (id_acteur, id_user, vote) VALUES (" .$getid.", ".$iduser.", ".$gett.")";
                         $ins=$bdd->prepare($req7);
                         $res6 = $ins->execute();
                         if($res6) echo "On vient d'ajouter le vote !";
                    }
                      
                        else 
                        {
                    // Pour inserer le vote
                        $req8="INSERT INTO vote (id_acteur, id_user, vote) VALUES (" .$getid.", ".$iduser.", ".$gett.")";
                            $ins=$bdd->prepare($req8);
                            $res7=$ins->execute();
                            if($res7) echo "On vient d'ajouter le vote !";
                        }
                    
               }
              header('Location: http://localhost/Projet/PageActeur.php?id='.$getid);
            }

            else 
            {
                exit('Erreur Fatale. <a href="PageActeur.php">Revenir à l\'accueil</a>');

            }
            
    }
    