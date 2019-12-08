<nav id="navbar" class="navbar sticky-top navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand ml-md-3" href="index.php">Imperacube</a>

  
  <?php include("navbar.php");?> 
  

  <div id="infosProfil">
    <div class="d-flex justify-content-end">
      <?php // Si le pseudo est défini, on affiche le pseudo, sinon on affiche les pages d'inscription et de connexion. 
        if(!empty($pseudo)){ 
        echo '<img class= "btn pr-2 d-none d-md-block menuProfil" src="imgMembres/thumbnail-' . $avatar . '" data-toggle="modal" data-target="#profil">';
        echo '<p class= "align-self-center mb-2 mb-md-0 menuProfil"><span class="d-none d-md-inline-block" >Bonjour ' . $pseudo.'</span>';
        echo '<a class="ml-3" href="deconnexion.php">Se déconnecter</a> </p>';
        } else {
        echo '<p class= "align-self-end mb-0"> <a class="ml-3" href="inscription.php">S\'inscrire</a>';
        echo '<a class="ml-3" href="connexion.php">Se connecter</a> </p>';
        }
      ?>
    </div>
  </div>
</nav>

<?php 
  if (isset($permission_lvl) && $permission_lvl >=5){
    echo ""
?>
<section id="volet">
    <?php if($slug == "admin") { echo '<p><a href="#">Panneau d\'administration</a></p>'; } ?>
    <p><a href="#">Panneau de modération</a></p>
    <div id="iconeVolet" href="#volet" class="ouvrirVolet"><i class="fas fa-cogs"></i></div>
</section>
<?php
  "'";}
?>

<!-- Panneau d'administration et/ou de modération si les membres ont les droits -->



  
    <!-- PROFIL : 
        - caché à la base
        - apparait lorsque l'on clique sur son avatar
        - possibilité de le modifier en appuyant sur un bouton
    -->

    <?php 
      if (isset($_SESSION['id'])){
        echo  ''
    ?>

    <div class="modal fade" id="profil" tabindex="-1" role="dialog" aria-labelledby="ouvrirProfil" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ouvrirProfil">Mon profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <main class="mx-2 pb-2 mx-md-5">
              <div class="jumbotron">
                <div class="d-flex justify-content-around mb-2 mb-md-5">
                  <h2 id="pseudo" class="text-center align-self-center mb-0"><?php echo $pseudo; ?> (<?php echo $role ?>)</h2>
                  <img id="avatar" src='imgMembres/thumbnail-<?php echo $avatar; ?>' alt="Avatar de profil">
                </div>
                <h3>Description : </h3>
                <p id="description" class="lead"><?php echo $description; ?></p>
                <hr class="my-4">
                <h3>Signature : </h3>
                <p id="signature"><?php echo $signature; ?></p>
              </div>
              <div class="text-center">
                <button id="modifierProfil" type="button" class="btn ml-auto text-center"><i class="fas fa-user-cog"></i></button>
              </div>
            </main>
          </div>
        </div>
      </div>
    </div>
    <!-- <div id="conteneurProfil" class="container-fluid">
      <div id="profil"> 
        <img id="quitterProfil" src="img/quitterProfil.png" alt="Icône pour quitter le profil">
        <h1 class="text-center py-5">
          Mon profil
          <img id="modifierProfil" src="img/modifierProfil.png" alt="Icône pour modifier le profil">
        </h1>

        <main class="mx-2 pb-2 mx-md-5">
          <div class="jumbotron">
            <div class="d-flex justify-content-around mb-2 mb-md-5">
              <h2 id="pseudo" class="text-center align-self-center mb-0"><?php echo $pseudo; ?></h2>
              <img id="avatar" src='imgMembres/thumbnail-<?php echo $avatar; ?>' class='<?php echo $rang; ?>' alt="Avatar de profil">
            </div>
            <h3>Description : </h3>
            <p id="description" class="lead"><?php echo $description; ?></p>
            <hr class="my-4">
            <h3>Signature : </h3>
            <p id="signature"><?php echo $signature; ?></p>
          </div>
        </main>
      </div>
    </div> -->
    <?php 
      '';
      }         
    ?>

    <!-- UPLOAD NEW AVATAR : 
        - caché à la base
        - apparait lorsque l'on clique pour modifier l'avatar
        - permet d'upload un nouvel avatar en supprimant l'ancien et le remplaçant dans la BDD
    -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Changer d'avatar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="function/modificationProfil.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <input type="file" class="form-control-file" id="nvllePhoto" aria-describedby="fileHelp" name="nvllePhoto">
                <small id="fileHelp" class="form-text text-muted"><p class="text-warning m-0">Vous pouvez selectionner un nouvel avatar. ATTENTION : l'ancien sera supprimé.</p> <p>Il ne doit pas faire plus de 30000 octets (30 KO). Seul les JPG, GIF et PNG sont autorisés.</p></small>
              </div>
              <input id="oldAvatar" name="oldAvatar" type="hidden" value='<?php echo $avatar; ?>'>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" id="newAvatar">Sauvegarder les changements</button>
            </div>
          </form>
        </div>
      </div>
    </div>
