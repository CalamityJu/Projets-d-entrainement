// On crée des variables globales
let pseudoGood = false, 
    passGood = false ;

window.onload = function(){

    let pseudoElt = document.getElementById("pseudo"),
        pass2Elt = document.getElementById("passwordConfirm");

    /* On écoute les changements sur les cases correspondant a :
        - le pseudo
        - les deux mots de passes
    */
   pseudoElt.addEventListener("change", checkPseudo);
   pass2Elt.addEventListener("change", checkPass);

}//window.onload

function checkPseudo() {
    pseudoGood = true;
    enableButton();
}

function checkPass() {
    let pass1Elt = document.getElementById("password"),
        pass2Elt = document.getElementById("passwordConfirm");
    if (pass1Elt.value === pass2Elt.value) {
        passGood = true;
    }
    enableButton();
}

function enableButton() {
    bouton = document.getElementById("buttonConnexion");
    if (pseudoGood && passGood) {
        bouton.removeAttribute("disabled")
        bouton.addEventListener("click", connexion);
    } else {
        bouton.setAttribute("disabled", "disabled");
    }
    
}

function connexion(){
    console.log("click");
    setTimeout(document.location.href=history.back(), 2000);
    console.log("click");
    
}