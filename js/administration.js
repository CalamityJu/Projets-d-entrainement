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

//Fonction qui ajoute la valeur à la modal lors de la suppression
$('#suppMembre').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipientName = button.data('membre_nom'); // Extract info from data-* attributes
    var recipientId = button.data('membre_id');
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-title').text('Suppression de ' + recipientName);
    modal.find('.modal-body input').val(recipientId);
    modal.find('.modal-body #avertissementSuppression').text('Vous êtes sur le point de supprimer ' + recipientName +". Cette action est irréversible.");
  });

  
// Fonction qui ajoute la valuer à la modal lors de la modification de grade
  $('#modifierGrade').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientName = button.data('membre_nom'); // Extract info from data-* attributes
    var recipientId = button.data('membre_id');
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-title').text('Modification du grade de ' + recipientName);
    modal.find('.modal-body input').val(recipientId);
  });