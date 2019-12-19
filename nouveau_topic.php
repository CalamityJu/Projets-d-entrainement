<?php
    //On récupère la catégorie de forum concerné
    $categorie_id = filter_input(INPUT_POST,'categorie_id',FILTER_SANITIZE_NUMBER_INT);
    require_once("template/debut.php"); // On insère le menu et on démarre la session. 
    require_once("template/menu.php"); // On insère le menu et on démarre la session. 
    require_once("template/forum_category.php");
    require_once("template/forum_topic_template.php");
    require_once("template/forum_post_template.php");

    //On vérifie que l'utilisateur a les accès
    if($user_permission < $view_auth || !isset($categorie_id)){
    echo "<div class='acces_interdit text-center mt-5'><h1>Accès interdit</h1>";
    echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès ou qui n'existe pas.</p>";
    echo "<p>Si vous êtes censé pouvoir vous connecter à cette page, essayez de vous reconnecter.</p>";
    echo "<p>Le problème persiste ? Contactez les administrateurs</p></div>";
    exit();
    }
?>
<script src="node_modules/ckeditor.js"></script>

<div id="forum_post">
    <header class="container-fluid m-auto p-0">
        <div class="banner-container p-0 d-none d-md-block">
            <div class="banner">
                <ul class="p-0 m-0">
                    <!--SLIDE-->
                    <li>
                        <img src="img/coucher-soleil.jpg" alt="Coucher de soleil de minecraft">
                    </li>
                </ul>
                <div class="loader"><img src="img/loader.gif" alt="Loader"></div>
            </div>
        </div>
    </header>
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-8 m-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="forum.php">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="forum_topic.php?id=<?php echo $categorie_id; ?>"><?php echo get_categorie_title($bdd, $categorie_id); ?></a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container p-0">
            <div class="row">
                <div class="col-12">
                    <h2>Creation d'un nouveau sujet</h2>
                    <!--Formulaire -->
                    <form action="function/ajout_topic.php" method="post">
                        <div class="modal-body">
                            <input id="categorie_id" type="hidden" name="categorie_id" value="<?= $categorie_id;?>">
                            <div class="form-group">
                                <label for="topic_title">Titre du sujet</label>
                                <input type="text" class="form-control" id="title_topic" name="topic_title" required>
                            </div>
                            <div class="form-group">
                                <label for="topic_message">Message</label>
                                <textarea type="text" class="form-control" id="topic_message" name="topic_message" rows="10" cols="80" required></textarea>
                                <script> CKEDITOR.replace( 'topic_message' );</script>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="forum_topic.php?id=<?php echo $categorie_id; ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button></a>
                            <button type="submit" class="btn btn-primary">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row text-center text-sm-left">
                <div class="col-lg-1 col-sm-2 logo">
                    <a href="#">
                        <img src="" alt="Logo d'Imperacube">
                    </a>
                </div>
                <div class="col-lg-8 col-sm-6 text-sm-center text-lg-left pl-lg-5">Copyrights 2019, imperacube.fr</div>
                <div class="col-lg-3 col-sm-4 sociconcent text-sm-right">
                    <ul class="socialicons p-0 mb-0">
                        <li>
                            <a href="#facebook">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/menu.js"></script>

<!-- Page d'exemple 

http://forum.azyrusthemes.com/index.html

Tu t'es arrêté au label des sidebackblock (radio checkbox)

-->