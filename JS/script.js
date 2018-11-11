document.onload = afficheInfos();

var btcancel = document.getElementById("btannulé");

btcancel.onclick = function(){
    afficheInfos();
}

function afficheInfos() {
    console.log("un message");
}

/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

/* COMBO BOX */

window.onload = function() {

    var jour = document.getElementById("jour");

    for (var i=0; i < 31; i++) {

        var opt = new Option();
        opt.value = i+1;
        opt.text = i+1;
        jour.add(opt);

    }
};

window.onload = function(){

    var annee = document.getElementById("annee");

    for (var j=2018; j > 1978; j--){

        var op= new Option();
        op.value = j-1;
        op.text = j-1;
        annee.add(op);

    }
};