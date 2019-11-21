<?php
    include("php/menu.php"); // On insère le menu et on démarre la session. 
?>

<h1 class="text-center my-5">Mon profil</h1>

<main class="container profil">
    <div class="jumbotron">
        <div class="d-flex justify-content-around mb-2 mb-md-5">
            <h2 id="pseudo" class="text-center align-self-center mb-0"> <?php echo $pseudo; ?></h2>
            <img src="imgMembres/defaultAvatar.png" class='<?php echo $rang; ?>' alt="Avatar de profil">
        </div>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>
</main>
