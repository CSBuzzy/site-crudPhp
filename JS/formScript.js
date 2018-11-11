/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/*AU CHARGEMENT DE LA PAGE, ON RENTRE LES DONNEES DE LA COMBO BOX*/

window.onload=function() {
    var cbjours = document.getElementById("cbjours");
    var mois=["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
    var cbmois = document.getElementById("mois");
    var cbannee = document.getElementById("annee");
    var year = new Date().getFullYear();

    for (var i = 1; i <= 31; i++) {
        var uneoption = new Option();
        uneoption.value = i ;
        uneoption.text = i ;
        cbjours.add(uneoption);
    }

    for (var i = 0; i < 12; i++) {
        var uneoption = new Option();
        uneoption.value = i+1 ;
        uneoption.text = mois[i] ;
        cbmois.add(uneoption);
    }

    for (var i=year+1; i>=1969; i--){
        var uneoption = new Option();
        uneoption.value=i;
        uneoption.text=i;
        cbannee.add(uneoption);

    }
}

/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/*ON AFFICHE SI L'ANNEE EST BIS OU NON DANS LA CONSOLE AU MOMENT DE LA SELECTION DE L'ANNEE*/

var cbannee = document.getElementById("annee");

function anneeBis() {

    var anneebis = cbannee.options[cbannee.selectedIndex].value;

    if (anneebis % 100 === 0 && anneebis % 4 !== 0 || anneebis % 400 === 0) {

        console.log("année bissextile");
    }
    else {
        console.log("année non bissextile");
    }

}

/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/*ON VERIFIE LES CHAMPS, SI CES DERNIERS SONT REMPLIS*/

function isValid(champ){
    if(champ.value.trim()===""){
        champ.style.borderColor = "red";
        champ.focus();
        return false;
    } else{
        champ.style.borderColor = "initial";
        return true;
    }
}
document.getElementsByTagName("input").onchange = function(){isValid();}


/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/*ALERT SI LE CHAMP N'EST PAS BIEN REMPLI*/

function FoncVerif(){

    var ok = true;

    $('select').each(function(){
        if ($(this).val()=='0'){
            alert('Il manque ' + $(this).data('libelle'));
            $(this).focus();
            ok = false;
            return false;
        }

    });

    $('input[type=text]').each(function () {
        if ($(this).val().trim() == '') {
            alert('Il manque le champ ' + $(this).data('libelle'));
            $(this).focus();
            ok = false;
            return false;
        }


    });

    $('input[type=email]').each(function () {
        if ($(this).val().trim() == '') {
            alert('Il manque le champ ' + $(this).data('libelle'));
            $(this).focus();
            ok = false;
            return false;
        }

    });

    $('select[name=cbannee]').each(function () {
        if ($(this).val() == 0) {
            alert('Il manque annee');
            $(this).focus();
            ok = false;
            return false;
        }

    });

    $('select[name=cbmois]').each(function () {
        if ($(this).val() == 0) {
            alert('Il manque le mois');
            $(this).focus();
            ok = false;
            return false;
        }

    });

    $('select[name=cbjours]').each(function () {
        if ($(this).val() == 0) {
            alert('Il manque le jour');
            $(this).focus();
            ok = false;
            return false;
        }

    });

    if($('input[type=checkbox][name=chkActivities]:checked').length == 0){
        alert('Faites un choix!');
        $(this).focus();
        ok=false;

    }
    return false;

    if($('input[type=radio][name=statut]:checked').length == 0){
        alert('Quel est votre statut?');
        $(this).focus();
        ok=false;
        //return false;
    }

    return false;

}

/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/* ENLEVER LE DISPLAY DU TEXTAREA QUAND 'AUTRES' EST SELECTIONNE */

var tabCheckbox = document.getElementsByName("chkActivities");
var chekAutres = tabCheckbox[tabCheckbox.length-1];

chekAutres.onchange = function(){
    var txtAutres = document.getElementById("txtAutres");
    if(this.checked) {
        txtAutres.disabled = false;
        txtAutres.focus();
    } else{
        txtAutres.disabled = true;
        txtAutres.value="";
    }
}

/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/*CHANGER LE JOUR SI ANNEE BISSEXTILE*/

/* 1-ON INSERE LE NB DE JOURS SELON LE MOIS*/

function updateCbJours(){
    var valMois = document.getElementById("mois").value;
    var valAnnee = document.getElementById("annee").value;
    var cbJours = document.getElementById("cbjours");
    var nbJours=0;
    cbJours.selectedIndex=0;

    if(valMois == 0 || valAnnee == 0){
        cbJours.disabled = true;
    }else{
        if
        (valMois == 4 || valMois == 6 || valMois == 9 || valMois == 11){
            nbJours = 30;

        }else if(valMois == 2){
            if(estBissextile(valAnnee)){
                nbJours=29;
            } else{
                nbJours=28;
            }
        }else{
            nbJours=31;
        }
        remplitCbJours(nbJours);
        cbJours.disabled = false;
    }
}

/* 2-EN VERIFIANT L'ANNEE BIS*/

function estBissextile(annee){
    return (annee %400 == 0 || annee%4 == 0 && annee%100 !=0);
}

function remplitCbJours(limite){
    var cbJours = document.getElementById("cbjours");
    cbJours.innerHTML="";
    for(var i =0; i<=limite; i++){
        var optJour = new Option();
        optJour.value = i;
        if(i==0){
            optJour.text="---";
        }else{
            optJour.text=i;
        }
        cbJours.add(optJour);
    }
}

/*A LA SELECTION DU MOIS ET DE L'ANNEE ON APPELLE LES FONCTIONS SUIVANTES*/

document.getElementById("mois").onchange = function(){updateCbJours();}
document.getElementById("annee").onchange = function(){
    updateCbJours();
    anneeBis();
}



