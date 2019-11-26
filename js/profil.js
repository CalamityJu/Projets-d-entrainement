//On initialise les variables globales
let tailleNavBar = $("#navbar").height(),
    switchProfil = false;

//On attends que le DOM soit chargé
$(function(){

    //EventListeners
    $(window).on("resize", redimensionner);
    $(".menuProfil").on("click", apparaitreProfil);
    $("#quitterProfil").on("click", apparaitreProfil);
    $("#modifierProfil").on("click", modifierProfil);
     
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
 * Fonction qui fait apparaitre le profil
 */
function apparaitreProfil(){
    console.log("click");
    if (switchProfil === false){
        switchProfil = true;
        $("#conteneurProfil").fadeIn(100, function(){
            $("#conteneurProfil").show();
        });

    } else {
        switchProfil = false;
        $("#conteneurProfil").fadeOut(100, function(){
            $("#conteneurProfil").hide();
        });
    }
}

/**
 * Fonction qui permet de modifier les informations du profil
 */
function modifierProfil(){
    $("#conteneurProfil #description").attr('contenteditable', 'true').css({
        border : "2px dotted grey",
        padding: "2px"
    });
    
    $("#conteneurProfil #signature").attr('contenteditable', 'true').css({
        border : "2px dotted grey",
        padding: "2px"
    });

    $("#conteneurProfil #avatar").attr('contenteditable', 'true').attr('data-toggle', 'modal').attr('data-target','#exampleModalCenter').css({
        border : "2px dotted grey",
        borderRadius: "50%",
        padding: "2px"
    });
    $("#conteneurProfil .jumbotron").append('<button id="modificationProfilButton" type="buton" class="btn btn-primary mx-auto">Enregistrer les modifications</button>');
    $("#modificationProfilButton").on("click", changeProfil);

}

/**
 * Fonction qui envoie les inforamtions de profil modifiée à la page PHP
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

    $("#conteneurProfil #description").attr('contenteditable', 'false').css({
        border : "unset",
        padding: "0"
    });

    $("#conteneurProfil #signature").attr('contenteditable', 'false').css({
        border : "unset",
        padding: "0"
    });

    $("#conteneurProfil #avatar").css({
        border : "unset",
        padding: "0"
    });

    $("#modificationProfilButton").remove();
}