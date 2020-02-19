<!-- Table qui liste les membres -->
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

<button id="afficher_liste_banni" type="button" class="btn btn-secondary">Obtenir la liste des bannis</button>



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
</div> <!-- Fin modal suppression membre -->


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
                            <?php 
                            while ($grade = $grades->fetch()) {
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
</div> <!-- Fin modal modifier grade-->