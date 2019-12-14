<?php

    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 
    
    if(!empty($_POST['forum_title']) && !empty($_POST['forum_description']) && !empty($_POST['autorisation_view']) && !empty($_POST['autorisation_post']) && !empty($_POST['autorisation_topic']) && !empty($_POST['autorisation_annonce']) && !empty($_POST['forum_id'])){
        $title = filter_input(INPUT_POST, 'forum_title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'forum_description', FILTER_SANITIZE_STRING);
        $view = intval(filter_input(INPUT_POST, 'autorisation_view', FILTER_SANITIZE_STRING));
        $post_message = intval(filter_input(INPUT_POST, 'autorisation_post', FILTER_SANITIZE_STRING));
        $topic = intval(filter_input(INPUT_POST, 'autorisation_topic', FILTER_SANITIZE_STRING));
        $annonce = intval(filter_input(INPUT_POST, 'autorisation_annonce', FILTER_SANITIZE_STRING));

        $req = $bdd->prepare('UPDATE forum_forum SET forum_title = :forum_title, forum_description = :forum_description, auth_view = :auth_view, auth_post = :auth_post, auth_topic = :auth_topic, auth_annonce = :auth_annonce WHERE forum_id = :forum_id');
        $req->execute(array(
            'forum_title' => $title,
            'forum_description' => $description,
            'auth_view' => $view,
            'auth_post' => $post_message,
            'auth_topic' => $topic,
            'auth_annonce' => $annonce,
            'forum_id' => $_POST['forum_id']
        ));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Il y a eu une erreur lors de l'ajout du forum.";
    } 
?>