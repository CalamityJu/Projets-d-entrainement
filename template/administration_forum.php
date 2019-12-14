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
                        <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#modifierForum" data-forum_id="<?= $forum['forum_id'];?>" data-forum_title="<?= $forum['forum_title'];?>" data-forum_description="<?= $forum['forum_description'];?>">Modifier forum</button>
                        <button type="button" class="dropdown-item my-0" data-toggle="modal" data-target="#suppForum" data-forum_id="<?= $forum['forum_id'];?>" data-forum_titre="<?= $forum['forum_title'];?>">Supprimer</button>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<button id="ajouter_forum" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ajoutForum">Ajouter forum</button>


<!-- Modal modifier forum -->
<div class="modal fade" id="modifierForum" tabindex="-1" role="dialog" aria-labelledby="modifForumLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modifForumLabel">Modifier forum</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="function/modification_forum.php" method="post">
            <div class="modal-body">
                <input id="forum_id" type="hidden" name="forum_id" value="<?= $forum['forum_id'];?>">
                <div class="form-group">
                    <label for="forum_title">Titre du forum</label>
                    <input type="text" class="form-control" id="title_forum" name="forum_title" required>
                </div>
                <div class="form-group">
                    <label for="forum_description">Description</label>
                    <input type="text" class="form-control" id="description_forum" name="forum_description" required>
                </div>
                <div class="form-group">
                    <label for="autorisation_view">Autorisation minimale pour voir le forum</label>
                    <select class="form-control" id="autorisation_view" name="autorisation_view">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "registered"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_post">Autorisation minimale pour répondre à un post dans le forum</label>
                    <select class="form-control" id="autorisation_post" name="autorisation_post">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "member"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_topic">Autorisation minimale pour créer un nouveau sujet dans le forum</label>
                    <select class="form-control" id="autorisation_topic" name="autorisation_topic">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "member"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_annonce">Autorisation minimale pour créer une annonce dans le forum</label>
                    <select class="form-control" id="autorisation_annonce" name="autorisation_annonce">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "modo"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
        </div>
    </div>
</div> <!-- Fin modal modifier forum-->

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


<!-- Modal création forum-->
<div class="modal fade" id="ajoutForum" tabindex="-1" role="dialog" aria-labelledby="ajoutForumLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ajoutForumLabel">Ajout d'un forum</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="function/ajout_forum.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="forum_title">Titre du forum</label>
                    <input type="text" class="form-control" id="forum_title" name="forum_title" placeholder="Titre du forum" required>
                </div>
                <div class="form-group">
                    <label for="forum_description">Description</label>
                    <input type="text" class="form-control" id="forum_description" name="forum_description" placeholder="Description du forum" required>
                </div>
                <div class="form-group">
                    <label for="autorisation_view">Autorisation minimale pour voir le forum</label>
                    <select class="form-control" id="autorisation_view" name="autorisation_view">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "registered"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_post">Autorisation minimale pour répondre à un post dans le forum</label>
                    <select class="form-control" id="autorisation_post" name="autorisation_post">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "member"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_topic">Autorisation minimale pour créer un nouveau sujet dans le forum</label>
                    <select class="form-control" id="autorisation_topic" name="autorisation_topic">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "member"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="autorisation_annonce">Autorisation minimale pour créer une annonce dans le forum</label>
                    <select class="form-control" id="autorisation_annonce" name="autorisation_annonce">
                        <?php 
                        $grades = $bdd->query('SELECT * FROM roles ORDER BY id DESC');
                        while ($grade = $grades->fetch()) {
                            if($grade['slug'] !== "ban"){
                                if($grade['slug'] == "modo"){ ?>
                                    <option value="<?=$grade['level']?>" selected><?=$grade['name']?></option>
                                <?php }else { ?>
                                    <option value="<?=$grade['level']?>"><?=$grade['name']?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
        </div>
    </div>
</div>

