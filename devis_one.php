<?php
include_once'database.php';?>
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
        <li><a href="form.php">Formulaire/Ajout</a></li>
        <li><a href="devis.php">Devis</a></li>
    </ul>
</nav>
<div id="searchDevis">
    <fieldset>
        <legend>Critères de recherche</legend>
        <label for="searchNom">Nom:</label>
        <input id="searchNom" type="text">
        </br>
        <label for="searchDate">Date:</label>
        <input id="searchDate" type="date">
        <label for="searchDate">à</label>
        <input id="searchDate" type="date">
        <input id="searchButton" type="image" src="Img/search.png">
    </fieldset>
</div>
<table>
    <thead>
    <tr>
        <td>Nom Client</td>
        <td>Prenom Client</td>
        <td>Date</td>
        <td>Montant HT</td>
        <td colspan="2">Actions</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tdbody"></td>
        <td class="tdbody"></td>
        <td class="tdbody"></td>
        <td class="tdbody"></td>
        <td><a href="devis.php"><img src="Img/back.png" alt="retour à la liste des devis"></a></td>
    </tr>
    </tbody>
</table>
<footer>
    <p class="footer">Made with cake by strawberry</p>
    <a href="https://wearespnfamily.weebly.com/" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
</footer>
<script src="https://use.fontawesome.com/dc03c46519.js"></script>
</body>
</html>