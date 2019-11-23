<div id="conteneurProfil" class="container-fluid">
  <div id="profil"> 
    <img id="quitterProfil" src="img/quitterProfil.png" alt="Icône pour quitter le profil">
    <h1 class="text-center py-5">
      Mon profil
      <a href="modificationProfil"><img id="modifierProfil" src="img/modifierProfil.png" alt="Icône pour modifier le profil"></a>
    </h1>

    <main class="mx-2 pb-2 mx-md-5">
      <div class="jumbotron">
        <div class="d-flex justify-content-around mb-2 mb-md-5">
          <h2 id="pseudo" class="text-center align-self-center mb-0"><?php echo $pseudo; ?></h2>
          <img src='<?php echo $avatar; ?>' class='<?php echo $rang; ?>' alt="Avatar de profil">
        </div>
        <h3>Description : </h3>
        <p class="lead"><?php echo $description; ?></p>
        <hr class="my-4">
        <h3>Signature : </h3>
        <p><?php echo $signature; ?></p>
      </div>
    </main>
  </div>
</div>