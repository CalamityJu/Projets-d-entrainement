<?php
    include("template/debut.php"); // On insère démarre la session et on démarre la page. 

    include("template/menu.php"); // On insère le menu. 

    //On vérifie que la personne a les accès
    if(!isset($slug) || $slug !== "admin"){
        echo "<div class='acces_interdit'><h1>Accès interdit</h1>";
        echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès</p></div>";
        die;
    } else {
        echo "<p>Youpi</p>";
    }
?>