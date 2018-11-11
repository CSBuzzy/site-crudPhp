<?php
include_once'database.php';
$id = isset($_GET['id'])?$_GET['id']:0;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Megrim|Muli:200" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Site</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="listing.php">Listing Clients</a></li>
        <li><a href="form.php">Formulaire/Ajout</a></li>
        <li><a href="#">Devis</a></li>
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
        <td>Client</td>
        <td>Date</td>
        <td>Montant HT</td>
        <td colspan="2">Actions</td>
    </tr>
    </thead>
    <tbody>
<?php
if (!is_null($id)){
    $query= 'select devis.id_devis, CONCAT(nom_client, \'\', prenom_client) as client, date_devis, 
  SUM(lignedevis.quantite*produit.prix_unitaire_ht) montant_ht from client inner join devis on client.id_client = devis.id_devis
  inner join lignedevis on devis.id_devis = lignedevis.id_devis inner join produit on produit.id_produit = lignedevis.id_produit
 group by client.id_client, devis.id_devis';
    $SQLStatement = $Conn->prepare($query);
    $SQLStatement->bindValue(':id', $id);
}else{
    $query = 'select devis.id_devis, CONCAT(nom_client, \'\', prenom_client) as client, date_devis, 
  SUM(lignedevis.quantite*produit.prix_unitaire_ht) montant_ht from client inner join devis on client.id_client = devis.id_devis
  inner join lignedevis on devis.id_devis = lignedevis.id_devis inner join produit on produit.id_produit = lignedevis.id_produit
 group by client.id_client, devis.id_devis';
    $SQLStatement = $Conn->prepare($query);
}
$script='';
$SQLStatement->execute();
if ($SQLStatement->rowCount() == 0){
    $script .='<tr><td colspan="5" class="tdbody">Aucun resultat!</td></tr>';
}else{

while($row=$SQLStatement->fetchObject()){
        $script.='<tr id="'.$row->id_devis.'">';
        $script.='<td class="tdbody">'.$row->client.'</td>';
        $script.='<td class="tdbody">'.$row->date_devis.'</td>';
        $script.='<td class="tdbody">'.$row->montant_ht.'</td>';
        $script.='<td><a href="devis_one.php?id='.$row->id_devis.'"><img src="Img/binoculars.png" alt="voir un element"></a></td>';
        $script.='<td><a href="impression.php?id='.$row->id_devis.'"><img src="Img/print.png" alt="imprimer"></a></td>';
        $script.='</tr>';
        }
    }
    print($script);
    $SQLStatement->closeCursor();
?>
    </tbody>
</table>
<table id="tab2" hidden></table>
<footer>
    <p class="footer">Made with cake by strawberry</p>
    <a href="https://wearespnfamily.weebly.com/" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
// display search bar
        if (<?php print(isset($_GET['id']) ? 'true' : 'false'); ?>) {
            $('div#searchDevis').css('display', 'none');
        }
// hide show
        var line = 0;
        $('td.tdbody').click(function(){
        $('table#tab2').html("");
        $(this).closest('tr').css('background-color','darkslategrey');
        $('table#tab2').append('<tr><td>Description</td><td>Ref</td><td>Qte</td><td>Montant ht</td><td>Taux tva</td></tr><tr><td class="tdbody">Pelle en fer, gravée</td><td class="tdbody">R101</td><td class="tdbody">2</td><td class="tdbody">50</td><td class="tdbody">20%</td></tr>');
        $('table#tab2').show();

        var currentLine = $(this).closest('tr').attr('id');
        if(line===currentLine){
            $('table#tab2').hide();
            $(this).closest('tr').css('background-color', '');
            line=0;
        }else{
            $('tr[id='+line+']').css('background-color','');
            line=currentLine;
        }
        });
   });
</script>
<script src="https://use.fontawesome.com/dc03c46519.js"></script>
</body>
</html>
