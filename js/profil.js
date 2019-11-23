//On initialise les variables globales
let tailleNavBar = $("#navbar").height(),
    switchButton = false;

//On attends que le DOM soit chargé
$(function(){

    //EventListeners
    $(window).on("resize", redimensionner);
    $(".menuProfil").on("click", apparaitreProfil);
    $("#quitterProfil").on("click", apparaitreProfil);

    //On cache le profil
    $("#conteneurProfil").hide();
     
});

/**
 * Fonction qui ajoute une marge au conteneur du profil si la hauteur de l'écran est sous 768px
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
    if (switchButton === false){
        switchButton = true;
        $("#conteneurProfil").fadeIn(100, function(){
            $("#conteneurProfil").show();
        });

    } else {
        switchButton = false;
        $("#conteneurProfil").fadeOut(100, function(){
            $("#conteneurProfil").hide();
        });
    }
}