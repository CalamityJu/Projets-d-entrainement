<?php

    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    if(isset($_POST['membre_id']) && !empty($_POST['membre_id'])){
        //Supprimer le membre
        $req = $bdd->prepare('DELETE FROM membres WHERE membre_id = ?');
        $req->execute(array($_POST['membre_id']));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Aucun membre n'est sélectionné.";
    }
?>