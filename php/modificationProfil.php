<?php
  // On démarre la session
  session_start();

  $id= $_SESSION['id'];

  // On se connecte à la bdd
  try {
    $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  } 

  if(isset($_POST['description'])) {
    $description = htmlspecialchars($_POST['description']);
    $_SESSION['description'] = $description;
  }
  if(isset($_POST['signature'])) {
    $signature = htmlspecialchars($_POST['signature']);
    $_SESSION['signature'] = $signature;
  }

  if(isset($description) || isset($signature)){
    $req = $bdd->prepare("UPDATE membres SET membre_description = :nvlle_description, membre_signature = :nvlle_signature WHERE membre_id = :id");
    $req->execute(array(
      'nvlle_description' => $description,
      'nvlle_signature' => $signature,
      'id' => $id
    ));
    $req->closeCursor();
    echo "C'est bon";
  }


  //Si changement de photo de profil

  if (isset($_FILES['nvlle_photo']) && !empty($_FILES['nvlle_photo']['tmp_name'])) {
    if ($_FILES['nvlle_photo']['error'] == 0){ 
        $file = $_FILES['nvlle_photo'];
        $actualName = $file['tmp_name'];
        $newName = bin2hex(random_bytes(32)); //On attribue un hash généré aléatoirement comme nouveau nom
        $path = "imgMembres"; // On attribut le chemin où seront stockées les photos

        // Le fichier ne doit pas faire plus de 30000 octets (30 KO)
        if ($file['size'] <= 30000 AND $file['size'] !== 0) { 
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

                        //On redimensionne l'image pour en créer un thumbnail et on l'insère dans le dossier imgMembres
                        //$imagePath
                        $thumbnailPath = $path.'/thumbnail-'.$newName.'.'.$extension;
                        $newWidth = 100;

                        $size = getimagesize($imagePath);
                        $width = $size[0];
                        $height = $size[0];
                        $newHeight = intval($newWidth*$height/$width);

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
                        $thumb = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($thumb, false); 
                        imagesavealpha($thumb, true); 
                        imagecopyresampled($thumb, $resize, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        switch($extension) {
                            case "jpg":
                            case "jpeg":
                                imagejpeg($thumb, $thumbnailPath, 85);
                                break;
                            case "png":
                                imagepng($thumb, $thumbnailPath, 0);
                                break;
                            case "gif": 
                                imagegif($thumb, $thumbnailPath, 85);
                                break;
                        }
                        // $fileUploaded = "Le fichier a bien été enregistré";
                    }
                }
            } else {
                $extensionError = "Le fichier n'est pas dans un format accepté";
            }
        } else {
            $sizeError = "Le fichier est vide ou trop volumineux";
        }
    } else {
        $imagePath="imgMembres/defaultAvatar";
        $thumbnailPath="";
        $transferError = "Il y a eu un soucis lors de l'upload de l'image";
    }
} else {
    $imagePath="imgMembres/defaultAvatar";
    $thumbnailPath="";
}


?>