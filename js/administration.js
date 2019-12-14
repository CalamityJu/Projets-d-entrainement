//Variables globales
let pageMembre = document.getElementById("admin_membres_page"),
    pageForum = document.getElementById("admin_forum_page");

window.onload = function() {
    //On commence par cacher tous les contenus exceptés les membres
    this.afficherPageMembre();

    //EventListeners sur les pages à afficher
    document.getElementById("admin_membres_link").addEventListener("click", afficherPageMembre);
    document.getElementById("admin_forum_link").addEventListener("click", afficherPageForum);
    document.getElementById("afficher_liste_banni").addEventListener("click", afficherListeBanni);

    let gradeMembreElmt = document.getElementsByClassName("gradeMembre");
    for(i=0; i < gradeMembreElmt.length; i++){
      if (gradeMembreElmt[i].textContent == "Banni"){
        gradeMembreElmt[i].parentElement.style.backgroundColor = "#d18b8b";
      }
    }

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

//Fonction qui ajoute la valeur à la modal lors de la suppression de membre
$('#suppMembre').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let recipientName = button.data('membre_nom'); // Extract info from data-* attributes
    let recipientId = button.data('membre_id');
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    let modal = $(this);
    modal.find('.modal-title').text('Suppression de ' + recipientName);
    modal.find('.modal-body input').val(recipientId);
    modal.find('.modal-body #avertissementSuppression').text('Vous êtes sur le point de supprimer ' + recipientName +". Cette action est irréversible.");
  });
  
// Fonction qui ajoute la valeur à la modal lors de la modification de grade
  $('#modifierGrade').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientName = button.data('membre_nom'); // Extract info from data-* attributes
    var recipientId = button.data('membre_id');
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-title').text('Modification du grade de ' + recipientName);
    modal.find('.modal-body input').val(recipientId);
  });

  /**
   * Fonction qui cache/affiche la liste des membres banni
   */
  function afficherListeBanni(){
    let gradeMembreElmt = document.getElementsByClassName("gradeMembre"),
      button = document.getElementById("afficher_liste_banni"),
      textButton = button.innerText;
    if(textButton == "Obtenir la liste des bannis"){
      for(i=0; i < gradeMembreElmt.length; i++){
        if (gradeMembreElmt[i].textContent != "Banni"){
          gradeMembreElmt[i].parentElement.style.display = "none";
          button.innerText = "Afficher tous les membres";
        }
      }
    } else {
      for(i=0; i < gradeMembreElmt.length; i++){
        gradeMembreElmt[i].parentElement.style.display = "table-row";
        button.innerText = "Obtenir la liste des bannis";
      }
    }
  }



//Fonction qui ajoute la valeur à la modal lors de la suppression de forum
$('#suppForum').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget); // Button that triggered the modal
  let forumName = button.data('forum_titre'); // Extract info from data-* attributes
  let forumId = button.data('forum_id');
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this);
  modal.find('#suppForumLabel').text('Suppression de ' + forumName);
  modal.find('.modal-body input').val(forumId);
  modal.find('.modal-body #avertissementSuppressionForum').text('Vous êtes sur le point de supprimer ' + forumName +". Cette action est irréversible.");
});