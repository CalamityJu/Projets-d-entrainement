<!-- ========================================================================
    PENSER A CHANGER LA PAGE DE REDIRECTION POUR INSCRIPTION UNE FOIS EN PROD
    ==========================================================================-->



<?php
    //On se connecte à la base de donnée
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    //Si l'utilisateur a enregistré des données dans le formulaire on vérifie qu'elles sont dans la base de donnée
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['hidden'])) {
        if (!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['passwordConfirm'])){
            $pseudoEntered = htmlspecialchars($_POST['pseudo']);
            $password1 = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['passwordConfirm']);
            $redirection = $_POST['hidden'];
            if($password1 == $password2) {
                //On récupère les informations de la base de donnée
                $req = $bdd->prepare('SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_pseudo = :pseudo');
                $req->execute(array('pseudo' => $pseudoEntered));
                $donnees = $req->fetch();
                $id = $donnees['membre_id'];
                $pseudoBase = $donnees['membre_pseudo'];
                $passBase = $donnees['membre_mdp'];
                $req->closeCursor();
                //On déchiffre le mdp 
                $isPasswordCorrect = password_verify($password1, $passBase);
                if (!isset($pseudoBase)){ // le pseudo est bien enregistré dans la base
                    $wrongInformation = "Le pseudo ou le mot de passe n'est pas bon.";
                } elseif (!$isPasswordCorrect) { // le mot de passe correspond bien au pseudo
                    $wrongInformation = "Le pseudo ou le mot de passe n'est pas bon.";
                } else { // Si tout est bon, on crée la session et on crée le cookie
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['pseudo'] = $pseudoEntered;

                    //On enregistre un token dans la bdd
                    $token = bin2hex(random_bytes(32));
                    $req = $bdd->prepare('UPDATE membres SET token_name = :new_token WHERE membre_id = :id');
                    $req->execute(array(
                        'id' => $id,
                        'new_token' =>$token
                    ));

                    //On crée un cookie avec le token et l'id
                    setcookie("id", $id, time() + 7*24*3600);
                    setcookie("token", $token, time() + 7*24*3600);

                    /*===========================================================================================================
                    ================================CHANGER LA DIRECTION DE LA PAGE D'INSCRIPTION================================
                    ===========================================================================================================*/
                    if($redirection === "http://localhost/projets-d-entrainement/inscription.php") {
                        $redirection = 'index.php';
                    }
                    header("Location:".$redirection);
                }
            } else {
                $passwordIncorrect = "Les mots de passes ne sont pas identiques";
            }
        } else {
            $missingInformations = "Il manque des informations";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inscription</title>

        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 mb-md-5 justify-content-between">
                <a class="navbar-brand ml-md-3" href="index.php">Imperacube</a>
                    <div>
                        <a class="ml-3" href="inscription.php">S'inscrire</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <form class="container mb-2 mb-md-5" method="post" action="">
            <fieldset>
                <legend class="text-success">Connexion</legend>
                <?php if(isset($missingInformations)){ echo '<p class="text-danger">* ' . $missingInformations . '</p>'; }?>
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <?php if(isset($pseudoAlreadyExists)){ echo '<p class="text-danger">* ' . $pseudoAlreadyExists . '</p>'; }?>
                    <input type="text" class="form-control" id="pseudo" maxlength="50" placeholder="Pseudo" name="pseudo">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <?php if(isset($passwordIncorrect)){ echo '<p class="text-danger">* ' . $passwordIncorrect . '</p>'; }?>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                </div>
                <div class="form-group">
                    <label for="passwordConfirm">Confirmation mot de passe</label>
                    <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirmation mot de passe" aria-describedby="passwordConfirm" name="passwordConfirm">
                    <small id="passwordConfirm" class="form-text text-muted">Veuillez ressaisir votre mot de passe.</small>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="hidden" maxlength="255" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" name="hidden" hidden="hidden">
                </div>
                <button type="submit" class="btn btn-primary" id="buttonConnexion">Submit</button>
            </fieldset>
            </form>
        </main>

        <!-- Fichiers Js -->
        <!--<script src="js/connexion.js"></script>-->
    </body>
</html>
