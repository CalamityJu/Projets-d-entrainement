// On crée des variables globales
let mailOk, pseudoOk, passOk;

//On attend que le DOM soit chargé
$(function() {

    let boutonElt = document.getElementById("valider"),
        mailElt = document.getElementById("email"),
        pseudoElt = document.getElementById("pseudo"),
        pass1Elt = document.getElementById("password"),
        pass2Elt = document.getElementById("passwordConfirm");

    /* On écoute les changements sur les cases correspondant a :
        - l'adresse email
        - le pseudo
        - les deux mots de passes
    */
    $("#email").on("change", verifMail);
    $("#pseudo").on("change", verifPseudo);
    $("#passwordConfirm").on("change", verifPass);

    //On cache le bouton

});//$function

function verifMail() {
    mailOk = true;
    showButton();
}

function verifPseudo() {
    pseudoOk = true;
    showButton();
}

function verifPass() {
    if ($("#password").val() === $(this).val()) {
        passOk = true;
    }
    showButton();
}

function showButton() {
    if (mailOk && pseudoOk && passOk) {
        $("#valider").removeAttr("disabled")
    } else {
        $("#valider").attr("disabled");
    }
}