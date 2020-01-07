<!-- CKEditor documentation 
https://ckeditor.com/docs/ckeditor4/latest/guide/dev_installation.html
-->
<?php

    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    $categorie_id = filter_input(INPUT_POST, 'categorie_id', FILTER_SANITIZE_STRING);
    $user_id = filter_input(INPUT_POST, 'user-id', FILTER_SANITIZE_STRING);
    $topic_title = filter_input(INPUT_POST, 'topic_title', FILTER_SANITIZE_STRING);
    $topic_message = filter_input(INPUT_POST, 'topic_message', FILTER_SANITIZE_STRING);

    $params= [
        'categorie_id' => $categorie_id,
        'user_id' =>$user_id,
        'topic_title' => $topic_title,
        'topic_message'=>$topic_message
    ];

    if(!empty($categorie_id) && !empty($topic_title) && !empty($topic_message) && !empty($user_id)){
        $req = $bdd->prepare('INSERT INTO forum_topic (topic_title, topic_message, topic_time, topic_member_id, topic_forum_id) VALUES (:topic_title, :topic_message, NOW(), :member_id, :categorie_id)');
        $req->execute(array(
            'topic_title' => $topic_title,
            'topic_message' => $topic_message,
            'member_id' => $user_id,
            'categorie_id' => $categorie_id
        ));
        $new_topic_id = $bdd->lastInsertId();
        $req->closeCursor();
        header('Location: ../forum_topic.php?id='.$categorie_id.'&id2='.$new_topic_id);
    }else {
        header('Location:'.  $_SERVER['HTTP_REFERER'] .'?id='.$categorie_id.'&alert=true');
    }
?>