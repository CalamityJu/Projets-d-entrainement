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
  if(isset($_SESSION['pseudo']) && isset($_SESSION['id'])) {
      $pseudo = $_SESSION['pseudo'];
      $id = $_SESSION['id'];
  } elseif (isset($_COOKIE["id"]) && isset($_COOKIE['token'])){
    $idCookie = htmlspecialchars($_COOKIE["id"]);
    $tokenCookie = htmlspecialchars($_COOKIE["token"]);
    //On récupère les informations de la bdd
    $req = $bdd->prepare('SELECT membre_id, membre_pseudo, token_name FROM membres WHERE membre_id = :id');
    $req->execute(array(
      'id' => $idCookie
    ));
    $donnees = $req->fetch();
    $id = $donnees['membre_id'];
    $tokenBase = $donnees['token_name'];
    $pseudo = $donnees['membre_pseudo'];
    $_SESSION['id'] = $idCookie;
    $_SESSION['pseudo'] = $pseudo;
    $req->closeCursor();
  
  } else {
      $pseudo = ""; 
  } 

  //On attribue le rang au joueur
  if(isset($rang)){
    
  } else {
    $rang = "visiteur";
  }

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>

    <!-- Contenu CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="css/profil.css">

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
      <a class="navbar-brand ml-md-3" href="index.php">Imperacube</a>

      <!-- PAS ENCORE IMPLEMENTE -- IL FAUDRA PENSER A ENLEVER justify-content-between DANS LA NAV AU DESSUS
      <?php include("navbar.php");?> 
      -->

        <div id="infosProfil">
            <?php // Si le pseudo est défini, on affiche le pseudo, sinon on affiche les pages d'inscription et de connexion. 
                if(!empty($pseudo)){ 
                  echo '<div class="d-md-flex"> <a href="profil.php"><img class= "modo d-none d-md-block" src="imgMembres/defaultAvatar.png"></a>';
                  echo '<p class= "align-self-center mb-0"><a class= "text-primary" href="profil.php">Bonjour ' . $pseudo . '</a>';
                  echo '<a class="ml-3" href="deconnexion.php">Se déconnecter</a> </p> </div>';
                } else {
                  echo '<p> <a class="ml-3" href="inscription.php">S\'inscrire</a>';
                  echo '<a class="ml-3" href="connexion.php">Se connecter</a> </p>';
                }
            ?>
        </div>
      </div>
    </nav>


