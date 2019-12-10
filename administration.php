<?php
    include("template/debut.php"); // On insère démarre la session et on démarre la page. 

    include("template/menu.php"); // On insère le menu. 

    //On vérifie que la personne a les accès
    if(!isset($slug) || $slug !== "admin"){
        echo "<div class='acces_interdit text-center mt-5'><h1>Accès interdit</h1>";
        echo "<p>Vous avez tentez d'accéder à une page pour laquelle vous n'avez pas les accès.</p>";
        echo "<p>Si vous êtes censé avoir les accès, essayez de vous reconnecter.</p>";
        echo "<p>Si le problème persiste contactez les administrateurs</p></div>";
        exit();
    }

    if(isset($_GET['supprime']) AND !empty($_GET['supprime'])){
        $supprime = (int) $_GET['supprime'];
        $req = $bdd->prepare('DELETE FROM membres WHERE membre_id = ?');
        $req->execute(array($supprime));
        $req->closeCursor();
    }

    $membres = $bdd->query('SELECT * FROM membres LEFT JOIN roles ON membres.role_id=roles.id ORDER BY membre_id DESC LIMIT 0,20');
?>

<section id="administration_page">
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
                <tr>
                <th scope="row"><?= $membre['membre_id']; ?></th>
                <td><?= $membre['membre_pseudo'];?></td>
                <td><?= $membre['name'];?></td>
                <td><?= $membre['membre_email'];?></td>
                <td><?= $membre['date_inscription'];?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="" method="post">
                                <input type="hidden" value="<?= $membre['membre_id'];?>">
                                <button class="dropdown-item my-0">Modifier rang</button>
                            </form>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suppMembre" data-whatever="<?= $membre['membre_id'];?>">Open modal for <?= $membre['membre_id'];?></button>
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Supprimer
                            </button> -->
                            <form action="" method="post">
                                <input type="hidden" value="<?= $membre['membre_id'];?>">
                                <button class="dropdown-item my-0">Bannir</button>
                            </form>
                        </div>
                    </div>
                </td>
                </tr>
                <tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- MODALS -->
    <div class="modal fade" id="suppMembre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
            </div>
        </div>
    </div>

    <form action="function/suppression_membre.php" method="post">
        <input type="hidden" name="supp_membre" value="<?= $membre['membre_id'];?>">
        <button class="dropdown-item my-0">Supprimer</button>
    </form>



    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Vous êtes sur le point de supprimer
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="function/suppression_membre.php" method="post">
                    <input type="hidden" name="supp_membre" value="<?= $membre['membre_id'];?>">
                    <button class="dropdown-item my-0">Supprimer</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <form action="function/suppression_membre.php" method="post">
        <input type="hidden" name="supp_membre" value="<?= $membre['membre_id'];?>">
        <button class="dropdown-item my-0">Supprimer</button>
    </form> -->



    <div id="admin_forum_page">
        <h2>Coucou forum </h2>
    </div>

    <ul>
        <?php while ($m = $membres->fetch()) { ?>
            <li>
                <?= $m['membre_id'] ?> : <?= $m['membre_pseudo']; ?> 
                - <a href="administration.php?supprime=<?=$m['membre_id'] ?>">Supprimer</a> 
            </li>
        <?php } ?>
    </ul>
</section>

<!-- Fichiers JS -->
<script src="js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/administration.js"></script>
</body>
</html>
