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
    if(isset($_SESSION['pseudo']) && isset($_SESSION['id']) && isset($_SESSION['signature']) && isset($_SESSION['description'])&& isset($_SESSION['avatar']) && isset ($_SESSION['role'])) {
        $pseudo = $_SESSION['pseudo'];
        $id = $_SESSION['id'];
        $signature = $_SESSION['signature'];
        $description = $_SESSION['description'];
        $avatar = $_SESSION['avatar'];
        $role = $_SESSION['role'];
        $slug = $_SESSION['slug'];
        $permission_lvl = $_SESSION['permission_lvl'];
    } elseif (isset($_COOKIE["id"]) && isset($_COOKIE['token'])){
        $idCookie = htmlspecialchars($_COOKIE["id"]);
        $tokenCookie = htmlspecialchars($_COOKIE["token"]);
        //On récupère les informations de la bdd
        $req = $bdd->prepare('SELECT membre_id, membre_pseudo, membre_description, membre_signature, membre_photo, membre_email, token_name, roles.name, roles.slug, roles.level FROM membres LEFT JOIN roles ON membres.role_id=roles.id WHERE membre_id = :id');
        $req->execute(array(
        'id' => $idCookie
        ));
        $donnees = $req->fetch();
        $id = $donnees['membre_id'];
        $tokenBase = $donnees['token_name'];
        $pseudo = $donnees['membre_pseudo'];
        $signature = $donnees['membre_signature'];
        $description = $donnees['membre_description'];
        $avatar = $donnees['membre_photo'];
        $role = $donnees['name'];
        $slug = $donnees['slug'];
        $email = $donnees['membre_email'];
        $permission_lvl = $donnees['level'];
        $_SESSION['id'] = $idCookie;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['description'] = $description;
        $_SESSION['signature'] = $signature;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['role'] = $role;
        $_SESSION['slug'] = $slug;
        $_SESSION['permission_lvl']=$permission_lvl;
        $req->closeCursor();
    
    } else {
        $pseudo = ""; 
    } 

    // On s'assure que le joueur n'est pas banni avant de continuer, sinon on le redirige à la page d'accueil
    $bannis = $bdd->query('SELECT * FROM membres_bannis');
    while($b = $bannis->fetch()){
        if (isset($pseudo) && $pseudo == $b['banni_pseudo']){
            header('Location:index.php');
        } elseif (isset($email) && $email == $b['banni_mail']){
            header('Location:index.php');
        }
    }

    //On attribue un permission_lvl de base aux visiteurs s'ils n'en ont pas encore
    if(empty($permission_lvl)){
        $permission_lvl = 0;
    }

    $user_permission = $permission_lvl;
    
    
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
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/profil.css">

    </head>
    <body>