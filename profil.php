<?php
    include("php/menu.php"); // On insère le menu et on démarre la session. 

    $req = $bdd->prepare('SELECT membre_signature, membre_description FROM membres WHERE membre_id = :id');
    $req->execute(array('id' => $id));
    $donnees= $req->fetch();
    $signature = $donnees['membre_signature'];
    $description = $donnees['membre_description'];
    $req->closeCursor();
?>

<div id="conteneurProfil" class="container-fluid">
    <div id="profil"> 

        <h1 class="text-center py-5">Mon profil</h1>

        <main class="mx-2 mx-md-5">
            <div class="jumbotron">
                <div class="d-flex justify-content-around mb-2 mb-md-5">
                    <h2 id="pseudo" class="text-center align-self-center mb-0"><?php echo $pseudo; ?></h2>
                    <img src="imgMembres/defaultAvatar.png" class='<?php echo $rang; ?>' alt="Avatar de profil">
                </div>
                <h3>Description : </h3>
                <p class="lead">Voici une description de test<?php echo $description; ?></p>
                <hr class="my-4">
                <h3>Signature : </h3>
                <p>Voici une signature de test<?php echo $signature; ?></p>
            </div>
        </main>
    </div>
</div>

<!-- Contenu Javascript -->
<script src="js/jquery.js"></script>
<script src="js/profil.js"></script>
