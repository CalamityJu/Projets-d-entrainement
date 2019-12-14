<?php

    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    if(isset($_POST['forum_id']) && !empty($_POST['forum_id'])){
        //Supprimer le forum
        $req = $bdd->prepare('DELETE FROM forum_forum WHERE forum_id = ?');
        $req->execute(array($_POST['forum_id']));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Aucun forum n'est sélectionné.";
    } 
?>