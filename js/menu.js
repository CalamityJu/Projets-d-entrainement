//On initialise les variables globales
let tailleNavBar = $("#navbar").height(),
    switchVolet = false;

//On attends que le DOM soit chargé
$(function(){

    //EventListeners
    $(window).on("resize", redimensionner);
    $("#modifierProfil").on("click", modifierProfil);
    $("#iconeVolet").on("click", toggleVolet);

     
});//$function

/**
 * Fonction qui ajoute une marge haute au conteneur du profil si la hauteur de l'écran est sous 768px
 */
function redimensionner() { 
    if ($(window).height() <=768){
        $("#conteneurProfil").css({
            marginTop: "tailleNavBar"
        });
    } else {
        $("#conteneurProfil").css("margin-top", "unset");
    }
};

/**
 * Fonction qui permet de modifier les informations du profil
 */
function modifierProfil(){
    $(".modal-body #description").attr('contenteditable', 'true').css({
        border : "2px dotted grey",
        padding: "2px"
    });
    
    $(".modal-body #signature").attr('contenteditable', 'true').css({
        border : "2px dotted grey",
        padding: "2px"
    });

    $(".modal-body #avatar").attr('contenteditable', 'true').attr('data-toggle', 'modal').attr('data-target','#exampleModalCenter').css({
        border : "2px dotted grey",
        borderRadius: "50%",
        padding: "2px"
    });
    $(".modal-body .jumbotron").append('<button id="modificationProfilButton" type="buton" class="btn btn-primary mx-auto">Enregistrer les modifications</button>');
    $("#modificationProfilButton").on("click", changeProfil);

}

/**
 * Fonction qui envoie les informations de profil modifiée à la page PHP
 */
function changeProfil(){
    let description = $("#description").text(),
        signature = $("#signature").text();

    $.ajax({
        url: "function/modificationProfil.php",
        type: "post",
        data: "description="+description+"&signature="+signature,
        dataType: "html",
        success : function(code_html, statut){
            console.log("Requête envoyé avec succès");
            console.log('Code html -> '+code_html);
        },
        error : function(resultat, statut, erreur){
            console.log("La requête n'a pas aboutie...");
            console.log(resultat);
            console.log(statut);
            console.log(erreur);
        }
    });

    //Méthode avec le $.post

    // $.post("function/modificationProfil.php",{
    //     "description" : description,
    //     "signature" : signature
    // }).fail(function(erreur){
    //     console.log(erreur);
    // });

    $(".modal-body #description").attr('contenteditable', 'false').css({
        border : "unset",
        padding: "0"
    });

    $(".modal-body #signature").attr('contenteditable', 'false').css({
        border : "unset",
        padding: "0"
    });

    $(".modal-body #avatar").css({
        border : "unset",
        padding: "0"
    });

    $("#modificationProfilButton").remove();
}


function toggleVolet(){
    if(switchVolet == false){
        switchVolet = true;
        $("#volet").css("left", "0px");
    }else{
        switchVolet = false;
        $("#volet").css("left", "-250px");
    }
}