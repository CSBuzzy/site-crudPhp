<?php include_once 'Personne.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Megrim|Muli:200" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Site</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="#">Listing Clients</a></li>
        <li><a href="form.php">Formulaire/Ajout</a></li>
        <li><a href="devis.php">Devis</a></li>
    </ul>
</nav>
<table>
    <thead>
    <tr>
        <td>Nom</td>
        <td>Prenom</td>
        <td>Age</td>
        <td>Email</td>
        <td colspan="3">Actions</td>
    </tr>
    </thead>
    <?php
    /* APPEL DU FICHIER DE CONNEXION */
    require_once ('database.php');
    //Attention si je recois un id sur cette page c'est que je cherche à le supprimer
    if (isset($_GET['id']) AND !empty($_GET)){
        $id = $_GET['id'];
        if ($id > 0){
            $SQLQuery = "DELETE FROM client WHERE id_client = :id";
            try{
                $SQLStatement = $Conn->prepare($SQLQuery);
                $SQLStatement->bindValue(':id', $id);

                if ($SQLStatement->execute()){
                    print('<script type="text/javascript">document.location.href=\'listing.php\';</script>');
                }else{
                    print("Erreur d'exécution de la requête de suppression !<br />");
                    var_dump($SQLStatement->errorInfo());
                }
            }catch (PDOException $ex){
                print("Erreur de préparation de la requête de suppression !<br />");
                print($ex->getMessage());
            }
        }
    }

    /*PARCOURS DU JEU DE DONNEES AP REQUETE*/
    $query = 'select * from typedecom inner join moyendecom on typedecom.id_typedecom = moyendecom.id_typedecom
inner join posseder on moyendecom.id_moyendecom = posseder.fk_posseder_moyendecom
right outer join client on posseder.fk_posseder_client = client.id_client';
    $result= $Conn->query($query);
    while($Row = $result->fetchObject()){
        $tabpersonne[] = new Personne($Row->id_client, $Row->nom_client, $Row->prenom_client, '',$Row->valeur);
    }

    /* AFFICHAGE DU TABLEAU */
    $script='';
    foreach($tabpersonne as $pers){
        $script.='<tr>';
        $script.='<td class="tdbody">'.$pers->getNom().'</td>';
        $script.='<td class="tdbody">'.$pers->getPrenom().'</td>';
        $script.='<td class="tdbody">'.$pers->getAge().'</td>';
        $script.='<td class="tdbody">'.$pers->getMail().'</td>';
        $script.='<td><a href="form.php?id='.$pers->getId().'"><img src="Img/editer.png" alt="modifier un element"></a></td>';
        $script.='<td><a href="listing.php?id='.$pers->getId().'"><img src="Img/supprimer.png" alt="supprimer de la liste"></a></td>';
        $script.='<td><a href="devis_one.php?id='.$pers->getId().'"><img src="Img/script.png" alt="devis du client"></a></td>';
        $script.='</tr>';
    }
    print($script);

    $result->closeCursor();
    ?>
</table>
<footer>
    <p class="footer">Made with cake by strawberry</p>
    <a href="https://wearespnfamily.weebly.com/" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
</footer>
<script src="https://use.fontawesome.com/dc03c46519.js"></script>
</body>
</html>
