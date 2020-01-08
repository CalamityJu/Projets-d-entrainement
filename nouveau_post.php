<?php
    // On démarre la session
    session_start();

    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    //On vérifie si l'utilisateur est déjà connecté, si c'est le cas, on attribut son pseudo à la variable $pseudo
    if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['signature']) && isset($_SESSION['description'])&& isset($_SESSION['avatar']) && isset ($_SESSION['role'])) {
        $pseudo = $_SESSION['pseudo'];
        $id = $_SESSION['id'];
        $signature = $_SESSION['signature'];
        $description = $_SESSION['description'];
        $avatar = $_SESSION['avatar'];
        $role = $_SESSION['role'];
        $slug = $_SESSION['slug'];
        $permission_lvl = $_SESSION['permission_lvl'];
    } elseif (isset($_COOKIE["id"]) && isset($_COOKIE['token'])){
        $idCookie = htmlspecialchars($_COOKIE["id"]);
        $tokenCookie = htmlspecialchars($_COOKIE["token"]);
        //On récupère les informations de la bdd
        $req = $bdd->prepare('SELECT membre_id, membre_pseudo, membre_description, membre_signature, membre_photo, membre_email, token_name, roles.name, roles.slug, roles.level FROM membres LEFT JOIN roles ON membres.role_id=roles.id WHERE membre_id = :id');
        $req->execute(array(
        'id' => $idCookie
        ));
        $donnees = $req->fetch();
        $id = $donnees['membre_id'];
        $tokenBase = $donnees['token_name'];
        $pseudo = $donnees['membre_pseudo'];
        $signature = $donnees['membre_signature'];
        $description = $donnees['membre_description'];
        $avatar = $donnees['membre_photo'];
        $role = $donnees['name'];
        $slug = $donnees['slug'];
        $email = $donnees['membre_email'];
        $permission_lvl = $donnees['level'];
        $_SESSION['id'] = $idCookie;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['description'] = $description;
        $_SESSION['signature'] = $signature;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['role'] = $role;
        $_SESSION['slug'] = $slug;
        $_SESSION['permission_lvl']=$permission_lvl;
        $req->closeCursor();
    
    } else {
        $pseudo = ""; 
    } 

    // On s'assure que le joueur n'est pas banni avant de continuer, sinon on le redirige à la page d'accueil
    $bannis = $bdd->query('SELECT * FROM membres_bannis');
    while($b = $bannis->fetch()){
        if (isset($pseudo) && $pseudo == $b['banni_pseudo']){
            header('Location:index.php');
        } elseif (isset($email) && $email == $b['banni_mail']){
            header('Location:index.php');
        }
    }

    //On attribue un permission_lvl de base aux visiteurs s'ils n'en ont pas encore
    if(empty($permission_lvl)){
        $permission_lvl = 0;
    }

    $user_permission = $permission_lvl;

    //On récupère la catégorie de forum concerné
    $categorie_id = filter_input(INPUT_POST,'categorie_id',FILTER_SANITIZE_NUMBER_INT);
    if(isset($_GET['id'])){
        $categorie_id = $_GET['id'];
    }
    $topic_id = filter_input(INPUT_POST,'topic_id',FILTER_SANITIZE_NUMBER_INT);
    if(isset($_GET['id2'])){
        $topic_id = $_GET['id2'];
    }
    
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nouveau topic</title>

        <!-- Load jquery and javascript-->
        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>
        
        <!-- Wysibb -->
        <link rel="stylesheet" href="css/wbbtheme.css">
        <script src="js/jquery.wysibb.js"></script>
        <script src="js/wysibbfr.js"></script>
        <script>
            $(function() {
                var optionsWbb = {
                    buttons: "bold,italic,underline,strike,sup,sub,|,img,link,|,fontcolor,fontsize,fontfamily,|,justifyleft,justifycenter,justifyright,|,quote,spoiler,|,smilebox",
                    lang: "fr"
                }
                $("#wysibb").wysibb(optionsWbb);
            })    
        </script>


        <!-- Contenu CSS -->
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/profil.css">

    </head>
    <body>

    <?php
    require_once("template/menu.php"); // On insère le menu et on démarre la session. 
    require_once("template/forum_category.php");
    require_once("template/forum_topic_template.php");
    require_once("template/forum_post_template.php");

    //On vérifie que l'utilisateur a les accès
    if($user_permission < $post_auth|| !isset($topic_id)){
    echo "<div class='acces_interdit text-center mt-5'><h1>Accès interdit</h1>";
    echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès ou qui n'existe pas.</p>";
    echo "<p>Si vous êtes censé pouvoir vous connecter à cette page, essayez de vous reconnecter.</p>";
    echo "<p>Le problème persiste ? Contactez les administrateurs</p></div>";
    exit();
    }
    ?>

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
                                    <li class="breadcrumb-item"><a href="forum_post.php?id=<?php echo $topic_id; ?>"><?php echo get_topic_title($bdd, $topic_id); ?></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="container p-0">
                    <div class="row">
                        <div class="col-12">
                            <h2>Creation d'une nouvelle réponse</h2>
                            <!--Formulaire -->
                            <form action="function/ajout_post.php" method="post">
                                <?php if(isset($_GET['alert'])) : ?>
                                    <span>Il y a eu une erreur lors de l'envoie du message</span>
                                <?php endif; ?>
                                <input id="categorie_id" type="hidden" name="categorie_id" value="<?= $categorie_id;?>">
                                <input id="topic_id" type="hidden" name="topic_id" value="<?= $topic_id;?>">
                                <input type="hidden" id="user_id" name="user-id" value="<?= $_SESSION['id'];?>">
                                <div class="form-group">
                                    <label for="wysibb">Message</label>
                                    <textarea type="text" class="form-control" id="wysibb" name="topic_message" rows="10" cols="80"></textarea>
                                </div>
                                <div class="d-flex justify-content-center m-3">
                                    <a href="forum_topic.php?id=<?php echo $categorie_id; ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button></a>
                                    <button type="submit" class="btn btn-primary ml-2">Publier</button>
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

<!-- Page d'exemple 

http://forum.azyrusthemes.com/index.html

Tu t'es arrêté au label des sidebackblock (radio checkbox)

-->