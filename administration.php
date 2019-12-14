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



        <!--Page de gestion des membres-->
        <div id="admin_membres_page">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Grade</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Date inscription</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($membre = $membres->fetch()) {?>
                    <tr id="ligneMembre">
                        <th scope="row"><?= $membre['membre_id']; ?></th>
                        <td class="pseudoMembre"><?= $membre['membre_pseudo'];?></td>
                        <td class="gradeMembre"><?= $membre['name'];?></td>
                        <td><?= $membre['membre_email'];?></td>
                        <td><?= $membre['date_inscription'];?></td>
                        <td>
                            <?php if($membre['name'] == "Banni"){?>
                                <form action="function/debannir_membre.php" method="post">
                                    <input type="hidden" name="membre_id" value="<?= $membre['membre_id'];?>">
                                    <button class="btn btn-secondary my-0" type="submit">Dé-bannir</button>
                                </form>
                            <?php }else { ?>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#modifierGrade" data-membre_nom="<?= $membre['membre_pseudo'];?>" data-membre_id="<?= $membre['membre_id'];?>">Modifier grade</button>
                                    <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#suppMembre" data-membre_nom="<?= $membre['membre_pseudo'];?>" data-membre_id="<?= $membre['membre_id'];?>">Supprimer</button>
                                    <form action="function/bannir_membre.php" method="post">
                                        <input type="hidden" name="membre_id" value="<?= $membre['membre_id'];?>">
                                        <button class="dropdown-item my-0 
                                        <?php 
                                        // On désactive le bouton bannir si le grade du membre est supérieur ou égal au grade de l'utilisateur
                                        if ($membre['level'] >= $_SESSION['permission_lvl']){
                                            echo "disabled";
                                        }   
                                        ?>">Bannir</button>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        
            <!-- Modal suppression membre -->
            <div class="modal fade" id="suppMembre" tabindex="-1" role="dialog" aria-labelledby="suppMembreLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suppMembreLabel">Suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="function/suppression_membre.php" method="post">
                        <div class="modal-body">
                        <div id="avertissementSuppression"></div>
                            <input type="hidden" name="membre_id" value="<?= $membre['membre_id'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal modifier grade -->
            <div class="modal fade" id="modifierGrade" tabindex="-1" role="dialog" aria-labelledby="modifRoleLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifRoleLabel">Modifier grade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="function/modification_grade_membre.php" method="post">
                        <div class="modal-body">
                            <div id="avertissementModificationGrade"></div>
                            <input type="hidden" name="membre_id" value="<?= $membre['membre_id'];?>">
                            <div class="form-group">
                                <select class="form-control" id="nouveau_role" name="nouveau_grade">
                                    <?php while ($grade = $grades->fetch()) {
                                        if($grade['slug'] !== "ban"){
                                    ?>
                                        <option value="<?=$grade['slug']?>"><?=$grade['name']?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <button id="afficher_liste_banni" type="button" class="btn btn-secondary">Obtenir la liste des bannis</button>
        </div>



        <!-- Page de gestion du forum-->

        <div id="admin_forum_page">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Autorisation de voir</th>
                        <th scope="col">Autorisation de poster</th>
                        <th scope="col">Autorisation de créer topic</th>
                        <th scope="col">Autorisation de poster des annonces</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($forum = $forums->fetch()) {?>
                    <tr id="ligneForum">
                        <th scope="row"><?= $forum['forum_id']; ?></th>
                        <td class="forumTitle"><?= $forum['forum_title'];?></td>
                        <td class="forumDescription"><?= $forum['forum_description'];?></td>
                        <td class="viewPermission"><?= $forum['auth_view'];?></td>
                        <td class="postPermission"><?= $forum['auth_post'];?></td>
                        <td class="topicPermission"><?= $forum['auth_topic'];?></td>
                        <td class="annoncePermission"><?= $forum['auth_annonce'];?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#modifierForum" data-forum_id="<?= $forum['forum_id'];?>" data-forum_titre="<?= $forum['forum_title'];?>">Modifier forum</button>
                                    <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#modifierPermissions" data-forum_view="<?= $forum['auth_view'];?>" data-forum_post="<?= $forum['auth_post'];?>" data-forum_topic="<?= $forum['auth_topic'];?>" data-forum_annonce="<?= $forum['auth_annonce'];?>" data-forum_id="<?= $forum['forum_id'];?>">Modifier permissions</button>
                                    <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#suppForum" data-forum_id="<?= $forum['forum_id'];?>" data-forum_titre="<?= $forum['forum_title'];?>">Supprimer</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <!-- Modal suppression forum -->
            <div class="modal fade" id="suppForum" tabindex="-1" role="dialog" aria-labelledby="suppForumLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suppForumLabel">Suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="function/suppression_forum.php" method="post">
                        <div class="modal-body">
                        <div id="avertissementSuppressionForum"></div>
                            <input type="hidden" name="forum_id" value="<?= $forum['forum_id'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
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
