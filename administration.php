<?php

    include("template/debut.php"); // On démarre la session et on démarre la page. 

    //On vérifie que l'utilisateur a les accès
    if(!isset($slug) || $slug !== "admin"){
        echo "<div class='acces_interdit text-center mt-5'><h1>Accès interdit</h1>";
        echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès.</p>";
        echo "<p>Si vous êtes censé avoir les accès, essayez de vous reconnecter.</p>";
        echo "<p>Le problème persiste ? Contactez les administrateurs</p></div>";
        exit();
    }

    //On récupère les éléments dont on aura besoin dans les différentes bases
    $membres = $bdd->query('SELECT * FROM membres LEFT JOIN roles ON membres.role_id=roles.id ORDER BY membre_id DESC LIMIT 0,20');
    $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
    $bannis = $bdd->query('SELECT * FROM membres_bannis');
    $forums = $bdd->query('SELECT * FROM forum_forum');

    
?>


    <section id="administration_page">
        <?php
            include("template/menu.php"); // On insère le menu. 
        ?>

        <!--Menu contenant les différentes pages de la page d'administration-->
        <ul class="nav">
            <li class="nav-item">
                <a id="admin_membres_link" class="nav-link active" href="#admin_membres_page">Membres</a>
            </li>
            <li class="nav-item">
                <a id="admin_forum_link" class="nav-link" href="#admin_forum_page">Forum</a>
            </li>
        </ul>


        <!-- PAGE MEMBRES-->

        <div id="admin_membres_page">
            <?php include("template/administration_membres.php");?> 
        </div> <!--Fin page membre -->



        <!-- PAGE FORUM -->
        
        <div id="admin_forum_page">
            <?php include("template/administration_forum.php");?> 
        </div>
    </section>


    <!-- Fichiers JS -->
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/administration.js"></script>
</body>
</html>
