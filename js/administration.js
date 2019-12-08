//Variables globales
let pageMembre = document.getElementById("admin_membres_page"),
    pageForum = document.getElementById("admin_forum_page");

window.onload = function() {
    //On commence par cacher tous les contenus exceptés les membres
    this.afficherPageMembre();

    //EventListeners sur les pages à afficher
    document.getElementById("admin_membres_link").addEventListener("click", afficherPageMembre);
    document.getElementById("admin_forum_link").addEventListener("click", afficherPageForum);

}//window.onload

/**
 * Fonction qui affiche le contenu sur les membres et masque les autres
 */
function afficherPageMembre(){
    pageMembre.style.display="initial";
    pageForum.style.display = "none";
}

/**
 * Fonction qui affiche le contenu sur le forum et masque les autres
 */
function afficherPageForum(){
    pageForum.style.display = "initial";
    pageMembre.style.display="none";
}