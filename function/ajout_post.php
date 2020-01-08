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

    $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_SANITIZE_STRING);
    $user_id = filter_input(INPUT_POST, 'user-id', FILTER_SANITIZE_STRING);
    $post_message = filter_input(INPUT_POST, 'topic_message', FILTER_SANITIZE_STRING);

    $params= [
        'topic_id' => $topic_id,
        'user_id' =>$user_id,
        'post_message'=>$topic_message
    ];

    if(!empty($topic_id) && !empty($post_message) && !empty($user_id)){
        $req = $bdd->prepare('INSERT INTO forum_post (post_message, post_time, post_member_id, post_topic_id) VALUES (:post_message, NOW(), :post_member_id, :post_topic_id)');
        $req->execute(array(
            'post_message' => $post_message,
            'post_member_id' => $user_id,
            'post_topic_id' => $topic_id
        ));
        $new_post_id = $bdd->lastInsertId();
        $req->closeCursor();
        header('Location: ../forum_topic.php?id='.$categorie_id.'&id2='.$topic_id);
    }else {
        header('Location:'.  $_SERVER['HTTP_REFERER'] .'?id='.$categorie_id.'&id2='.$topic_id.'&alert=true');
    }
?>