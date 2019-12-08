<?php
    if(isset($_SESSION['pseudo']) && isset($_SESSION['id'])){
        header('Location: index.php');
        die();
    }

    //On se connecte à la base de donnée
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    //Si l'utilisateur a enregistré des données dans le formulaire on les vérifies et on les insère dans la base de donnée. 
    if (isset($_POST['pseudo']) AND isset($_POST['password']) AND isset($_POST['passwordConfirm']) AND isset($_POST['email'])){
        if (!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['passwordConfirm']) AND !empty($_POST['email']) AND empty($_POST['hidden'])){

            //On associe les entrées de l'utilisateur a des variables en échapant le code
            $pseudoAsked = htmlspecialchars($_POST['pseudo']);
            $pseudoAsked = strtolower($pseudoAsked); // On passe le pseudo en minuscule
            $pseudoAsked = ucfirst($pseudoAsked); // On met une majuscule à la première lettre
            $emailAsked = htmlspecialchars($_POST['email']);
            $password1 = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['passwordConfirm']);

            //Si l'utilisateur a entré des informations suplémentaires (description, photo, signature), on les attribut à des valeurs
            !empty($_POST['description']) ? $description = htmlspecialchars($_POST['description']) : $description = "";
            !empty($_POST['signature']) ? $signature = htmlspecialchars($_POST['signature']) : $signature = "";
            !empty($_POST['sexeMembre']) ? $sexe = $_POST['sexeMembre']: $sexe = "indeterminé";
            // Si le fichier a été envoyé sans erreur
            if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
                if ($_FILES['photo']['error'] == 0){ 
                    $file = $_FILES['photo'];
                    $actualName = $file['tmp_name'];
                    $newName = bin2hex(random_bytes(32)); //On attribue un hash généré aléatoirement comme nouveau nom
                    $path = "imgMembres"; // On attribut le chemin où seront stockées les photos

                    // Le fichier ne doit pas faire plus de 100000 octets (30 KO)
                    if ($file['size'] <= 100000 AND $file['size'] !== 0) { 
                        $infosFichier = pathinfo($file['name']);
                        $extension = $infosFichier['extension'];
                        $legalExtensions = array("jpg", "png", "gif", "jpeg");

                        // On s'assure que le fichier soit un jpg, un gif ou un png
                        if (in_array($extension, $legalExtensions)){ 
                            $imagePath = $path.'/'.$newName.'.'.$extension;
                            //On vérifie que le nom du fichier n'existe pas
                            if (file_exists($imagePath)) {
                                $fileAlreadyExists = "Un fichier portant ce nom existe déjà. Merci de choisir un autre nom pour votre fichier";
                                echo $fileAlreadyExists;
                            } else {
                                // Si tout se passe bien, on déplace le fichier dans le dossier des images des membres
                                if (!move_uploaded_file($actualName, $imagePath)){
                                    echo "Probleme";
                                }else{
                                    //On crée le nom qu'on insérera dans la bdd 
                                    $nameImageBdd = $newName.'.'.$extension;

                                    //On redimensionne l'image pour en créer un thumbnail et on l'insère dans le dossier imgMembres
                                    $thumbnailPath = $path.'/thumbnail-'.$nameImageBdd;

                                    switch($extension) {
                                        case "jpg":
                                        case "jpeg":
                                            $resize = imagecreatefromjpeg($imagePath);
                                            break;
                                        case "png":
                                            $resize = imagecreatefrompng($imagePath);
                                            break;
                                        case "gif": 
                                            $resize = imagecreatefromgif($imagePath);
                                            break;
                                    }

                                    list($w, $h) = getimagesize($imagePath);
                                    if($w > $h) {
                                        $newHeight = 100;
                                        $newWidth = floor($w * ($newHeight / $h));
                                        $crop_x = ceil(($w-$h)/2);
                                        $crop_y = 0;
                                    } else {
                                        $newWidth = 100;
                                        $newHeight = floor($h * ($newWidth/ $w));
                                        $crop_x = 0;
                                        $crop_y = ceil(($h - $w)/2);
                                    }


                                    $thumb = imagecreatetruecolor(100, 100);
                                    imagealphablending($thumb, false); 
                                    imagesavealpha($thumb, true); 

                                    imagecopyresampled($thumb, $resize, 0, 0, $crop_x, $crop_y, $newWidth, $newHeight, $w, $h);

                                    switch($extension) {
                                        case "jpg":
                                        case "jpeg":
                                            imagejpeg($thumb,$thumbnailPath, 85);
                                            break;
                                        case "png":
                                            imagepng($thumb,$thumbnailPath, 0);
                                            break;
                                        case "gif": 
                                            imagegif($thumb,$thumbnailPath, 85);
                                            break;
                                    }
                                    // $fileUploaded = "Le fichier a bien été enregistré";
                                    imagedestroy($thumb);
                                }
                            }
                        } else {
                            $extensionError = "Le fichier n'est pas dans un format accepté";
                            echo $extensionError;
                        }
                    } else {
                        $sizeError = "Le fichier est vide ou trop volumineux";
                        echo $sizeError;
                    }
                } else {
                    $nameImageBdd="defaultAvatar.png";
                    $transferError = "Il y a eu un soucis lors de l'upload de l'image";
                    echo $transferError;
                }
            } else {
                $nameImageBdd= "defaultAvatar.png";
                echo "ici";
            }
        } else {
            $missingInformations = "Il manque des informations";
            echo $missingInformations;
        }

        if (isset($pseudoAsked) && isset($emailAsked) && isset($password1) && isset($password2) && isset($description) && isset($nameImageBdd) && isset($signature) && empty($_POST['hidden'])) {
            //On vérifie que les informations sont valide (pseudo disponible, mots de passe identique)
            $req = $bdd->prepare('SELECT membre_pseudo, membre_email FROM membres WHERE membre_pseudo = :pseudo OR membre_email = :email');
            $req->execute(array(
                'pseudo' => $pseudoAsked,
                'email' => $emailAsked
            ));
            $donnees = $req->fetch();
            $pseudoExisting = $donnees['membre_pseudo'];
            $emailExisting = $donnees['membre_email'];
            $req->closeCursor();
            if($pseudoAsked === $pseudoExisting) {
                $pseudoAlreadyExists = "Le pseudo demandé est déjà attribué";
            } else if ($emailAsked === $emailExisting) {
                $emailAlreadyExists = "Un compte avec cette adresse mail existe déjà";
            } else if ($password1 != $password2) {
                $passwordIncorrect = "Les mots de passes ne sont pas identiques";
            } else {
                $passwordHash = password_hash($password1, PASSWORD_DEFAULT);
                //On insère les informations dans la base de donnée
                $req = $bdd->prepare('INSERT INTO membres(membre_pseudo, membre_email, membre_mdp, membre_description, membre_photo, membre_signature, date_inscription) VALUES(:pseudo, :email, :pass, :descrip, :photo, :signat, NOW())');
                $req->execute(array(
                    'pseudo'=>$pseudoAsked,
                    'email'=>$emailAsked,
                    'pass'=>$passwordHash,
                    'descrip'=>$description,
                    'photo'=>$nameImageBdd,
                    'signat'=>$signature
                ));
                $req->closeCursor();
                header('Location: index.php');
                echo "Inscription validée";
            }
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
                        <a class="ml-3" href="connexion.php">Se connecter</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>

            <!-- Formulaire d'inscription -->
            <form class="container mb-2 mb-md-5" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-success">Inscription</legend>
                    <?php if(isset($missingInformations)){ echo '<p class="text-danger">* ' . $missingInformations . '</p>'; }?>
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <?php if(isset($emailAlreadyExists)){ echo '<p class="text-danger">* ' . $emailAlreadyExists . '</p>'; }?>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@email.com" name="email">
                        <small id="emailHelp" class="form-text text-muted">On ne partagera jamais votre adresse email.</small>
                    </div>
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
                        <label for="description">Description</label>
                        <small id="facultatif" class="form-text text-muted">Facultatif</small>
                        <textarea class="form-control" id="description" rows="3" placeholder="Parlez-nous un peu de vous. Cela permet aux autres membres de vous connaitre." name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo de profil</label>

                        <input type="file" class="form-control-file" id="photo" aria-describedby="fileHelp" name="photo">
                        <small id="fileHelp" class="form-text text-muted">Vous pouvez selectionner un avatar ou une photo de profil. Elle ne doit pas faire plus de 100000 octets (100 KO). Seul les JPG, GIF et PNG sont autorisés.</small>
                    </div>
                    <div class="form-group">
                        <label for="pseudo">Signature</label>
                        <?php 
                            if(isset($transferError)){ 
                                echo '<p class="text-danger">* ' . $transferError . '</p>'; 
                            } elseif (isset($sizeError)) {
                                echo '<p class="text-danger">* ' . $sizeError . '</p>';
                            } elseif (isset($extensionError)) {
                                echo '<p class="text-danger">* ' . $extensionError . '</p>';
                            }
                        ?>
                        <small id="facultatif" class="form-text text-muted">Facultatif</small>
                        <input type="text" class="form-control" id="pseudo" maxlength="255" placeholder="Signature" name="signature">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="hidden" maxlength="255" placeholder="Hidden" name="hidden" hidden="hidden">
                    </div>
                    <fieldset class="form-group">
                        <legend>Sexe</legend>
                        <div class="form-check">
                            <label class="sexe_neutre">
                            <input type="radio" class="form-check-input" name="sexeMembre" id="sexe_neutre" value="Indéterminé" checked="checked">
                            Indeterminé
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="feminin">
                            <input type="radio" class="form-check-input" name="sexeMembre" id="feminin" value="feminin">
                            Féminin
                            </label>
                        </div>
                        <div class="form-check disabled">
                            <label class="masculin">
                            <input type="radio" class="form-check-input" name="sexeMembre" id="masculin" value="masculin">
                            Masculin
                            </label>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary mx-auto" id="valider" disabled>Valider</button>
                </fieldset>
            </form>
        </main>

        <script src="js/jquery.js"></script>
        <script src="js/inscription.js"></script>
    </body>
</html>