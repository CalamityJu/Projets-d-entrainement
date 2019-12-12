<?php
    include("template/debut.php"); // On démarre la session et on démarre la page. 

    //On vérifie que la personne a les accès
    if(!isset($slug) || $slug !== "admin"){
        echo "<div class='acces_interdit text-center mt-5'><h1>Accès interdit</h1>";
        echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès.</p>";
        echo "<p>Si vous êtes censé avoir les accès, essayez de vous reconnecter.</p>";
        echo "<p>Si le problème persiste contactez les administrateurs</p></div>";
        exit();
    }

    $membres = $bdd->query('SELECT * FROM membres LEFT JOIN roles ON membres.role_id=roles.id ORDER BY membre_id DESC LIMIT 0,20');
    $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
    $bannis = $bdd->query('SELECT * FROM membres_bannis');
?>

<section id="administration_page">

    <?php
        include("template/menu.php"); // On insère le menu. 
    ?>
    <ul class="nav">
        <li class="nav-item">
            <a id="admin_membres_link" class="nav-link active" href="#">Membres</a>
        </li>
        <li class="nav-item">
            <a id="admin_forum_link" class="nav-link" href="#">Forum</a>
        </li>
    </ul>

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
                                    <button class="dropdown-item my-0">Bannir</button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>


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
            </form>
            </div>
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

    <button type="button" class="btn btn-secondary">Obtenir la liste des bannis</button>

    <div id="liste_des_bannis">
        <ul>
            <?php while ($banni = $bannis->fetch()) {?>
                <li><?= $banni['banni_pseudo'];?></li>
            <?php } ?>
        </ul>
    </div>

    <div id="admin_forum_page">
        <h2>Coucou forum </h2>
    </div>
</section>

<!-- Fichiers JS -->
<script src="js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/menu.js"></script>
<script src="js/administration.js"></script>
</body>
</html>
