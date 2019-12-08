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
                                <input type="hidden" id="hidden" value="<?= $membre['membre_id'];?>">
                                <button class="dropdown-item my-0">Modifier rang</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" id="hidden" value="<?= $membre['membre_id'];?>">
                                <button class="dropdown-item my-0">Supprimer</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" id="hidden" value="<?= $membre['membre_id'];?>">
                                <button class="dropdown-item my-0">Bannir</button>
                            </form>
                            <div class="dropdown-item btn-group dropright">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropright
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Dropdown menu links -->
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                </tr>
                <tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

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
