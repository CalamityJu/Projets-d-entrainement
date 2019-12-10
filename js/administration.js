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

//Fonction qui ajoute la valeur à la modal

$('#suppMembre').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
  })