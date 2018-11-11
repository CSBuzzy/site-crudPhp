<?php require_once('database.php'); ?>
<?php if (!empty($_GET)){
    //J'arrive sur le formulaire avec un id dans la barre d'adresse
    //Cela veut dire que je viens soit pour charger les informations d'une personne à modifier soit pour enregistrer les modifications sur la personne
    $id = isset($_GET['id'])?$_GET['id']:0;

    //Si j'ai des informations dans le POST c'est que je viens du formulaire donc je dois exécuter un UPDATE
    if (!empty($_POST)){
        //Je dois exécuter un UPDATE
        $nom = $_POST['nom'];
        $prenom  = $_POST['prenom'];
        $SQLQuery = 'UPDATE client SET nom_client = :nom, prenom_client = :prenom WHERE id_client = :id';
        $SQLStatement = $Conn->prepare($SQLQuery);
        $SQLStatement->bindValue(':id', $id);
        $SQLStatement->bindValue(':nom', $nom);
        $SQLStatement->bindValue(':prenom', $prenom);

        if ($SQLStatement->execute()){
            print('<script type="text/javascript">document.location.href=\'listing.php\';</script>');
        }else{
            print("Erreur d'exécution de la requête de mise à jour !<br />");
            var_dump($SQLStatement->errorInfo());
        }
    }else{
        //Je dois faire un select
        $SQLQuery = 'SELECT * FROM client WHERE id_client = :id';
        $SQLStatement = $Conn->prepare($SQLQuery);
        $SQLStatement->bindValue(':id', $id);
        $SQLStatement->execute();

        $SQLResult = $SQLStatement->fetchObject();
        $nom = $SQLResult->nom_client;
        $prenom = $SQLResult->prenom_client;
        $mail = $SQLResult->valeur;

        $SQLStatement->closeCursor();
    }
}else{
    //J'arrive sur le formulaire sans id dans la barre d'adresse
    //Cela veut dire que j'arrive soit pour renseigner les informations d'une nouvelle personne soit pour enregistrer les informations d'une nouvelle personne

    if (!empty($_POST)){
        //Je dois exécuter un INSERT
        $nom = $_POST['nom'];
        $prenom  = $_POST['prenom'];
        $SQLQuery = 'INSERT INTO client(nom_client, prenom_client, date_naissance_client, id_civilite) VALUES (:nom, :prenom, :dateNaissance, :idcivilite)';
        $SQLStatement = $Conn->prepare($SQLQuery);
        $SQLStatement->bindValue(':nom', $nom);
        $SQLStatement->bindValue(':prenom', $prenom);
        $SQLStatement->bindValue(':dateNaissance', '1982-12-12');
        $SQLStatement->bindValue(':idcivilite', 1);

        if ($SQLStatement->execute()){
            print('<script type="text/javascript">document.location.href=\'listing.php\';</script>');
        }else{
            print("Erreur d'exécution de la requête d'insertion !<br />");
            var_dump($SQLStatement->errorInfo());
        }
    }else{
        //Je ne dois rien faire
        $nom = '';
        $prenom = '';
        $mail = '';
    }
} ?>
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
        <li><a href="listing.php">Listing Clients</a></li>
        <li><a href="#">Formulaire/Ajout</a></li>
        <li><a href="devis.php">Devis</a></li>
    </ul>
</nav>
<form action="" method="POST" enctype="multipart/form-data" name="formclient">
    <fieldset>
        <legend>Informations Personnelles:</legend>
    <label>Civilité:</label>
    <select data-libelle="la civilité" name="civilité">
        <option name="radioCiv" value="0">---</option>
        <option name="radioCiv" value="1">Madame</option>
        <option name="radioCiv" value="2">Monsieur</option>
    </select>
    <br>
    <label for="nom">Nom:</label>
    <input data-libelle="nom" type="text" id="nom" name="nom" value="<?php print($nom)?>">
    <br>
    <label for="prenom">Prenom:</label>
    <input data-libelle="prenom" type="text" id="prenom" name="prenom" value="<?php print($prenom)?>">
    <br>
    <label for="mail">Mail:</label>
    <input data-libelle="mail" type="email" id="mail" value="<?php print($mail)?>">
    <br>
    <label>Date de Naissance:</label>
    <select data-libelle="cbjours" name="cbjours" id="cbjours" disabled="disabled">
        <option value="0">---</option>
    </select>
    <select data-libelle="cbmois" name="cbmois" id="mois">
        <option value="0"></option>
    </select>
    <select data-libelle="cbannee" name="cbannee" id="annee">
        <option value="0"></option>
    </select>
    </fieldset>
    <br>
    <fieldset>
        <legend>Informations Complémentaires:</legend>
    <label>Centres d'Interets:</label>
    <br>
    <label for="cinema">Cinéma</label>
    <input name="chkActivities" id="cinema" type="checkbox" value="cinéma">
    <label for="lecture">Lecture</label>
    <input name="chkActivities" id="lecture" type="checkbox" value="lecture">
    <label for="sport">Sport</label>
    <input name="chkActivities" id="sport" type="checkbox" value="sport">
    <label for="txtAutres">Autres</label>
    <input name="chkActivities"  type="checkbox" value="autres">
    <br>
    <label>Précisez:</label>
    <textarea name="txtAutres" id="txtAutres" disabled="disabled"></textarea>
    <br>
    <label>Statut:</label><br>
    <label for="etudiant">Etudiant</label>
    <input id="etudiant" type="radio" value="étudiant" name="statut">
    <label for="salarie">Salarié</label>
    <input id="salarie" type="radio" value="salarié" name="statut">
    <label for="PE">Inscrit à P.E</label>
    <input id="PE" type="radio" value="chômeur" name="statut">
    <br>
    </fieldset>
    <input type="submit" value="valider">
    <input type="reset" id="btannuler" value="annuler">
    <button type="button">supprimer</button>
    <br>
</form>
<br>
<footer>
    <p class="footer">Made with cake by strawberry</p>
    <a href="https://wearespnfamily.weebly.com/" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="JS/formScript.js"></script>
<script type="text/javascript">
    $('form[name=formclient]').submit(function(){
        return FoncVerif();
    });
</script>
<script type="text/javascript" src="JS/script.js"></script>

<script src="https://use.fontawesome.com/dc03c46519.js"></script>
</body>
</html>