//On initialise les variables globales
let tailleNavBar = $("#navbar").height(),
    switchButton = false;

//On attends que le DOM soit chargé
$(function(){

    //EventListeners
    $(window).on("resize", redimensionner);
    $("#menuProfil").on("click", apparaitreProfil);

    //On cache le profil
    $("conteneurProfil").hide();
     
});

/**
 * Fonction qui ajoute une marge au conteneur du profil si la hauteur de l'écran est sous 768px
 */
function redimensionner() { 
    if ($(window).height() <=768){
        $("#conteneurProfil").css("margin-top", tailleNavBar);
    } else {
        $("#conteneurProfil").css("margin-top", "unset");
    }
};

/**
 * Fonction qui fait apparaitre le profil
 */
function apparaitreProfil(){
    if (switchButton === false){
        switchButton = true;

    } else {
        switchButton = false;
    }
}