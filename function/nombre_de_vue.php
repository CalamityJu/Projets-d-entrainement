<?php

function compter_nombre_de_vues($bdd, $topic_id){
    $id_article = $topic_id;
    $timestamp_actual = date('U');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_last_view = $bdd ->prepare('SELECT * FROM forum_vues WHERE user_ip = :user_ip AND topic_id = :topic_id ORDER BY vues_id DESC LIMIT 0,1');
    $user_last_view->execute(array('user_ip'=>$user_ip, 'topic_id'=>$id_article));
    $user_last_view_is = $user_last_view->rowCount();
    if($user_last_view_is ==1){
        $inactive_minutes = 30;
        $inactive_secondes = $inactive_minutes*60;
        $user_last_view_timestamp_time = $user_last_view->fetch();
        $user_last_view_timestamp_time = $user_last_view_timestamp_time['timestamp_time'];
        if($timestamp_actual-$inactive_secondes > $user_last_view_timestamp_time){
            $add_view = $bdd->prepare('INSERT INTO forum_vues(user_ip, topic_id, timestamp_time) VALUES (?, ?, ?)');
            $add_view->execute(array($user_ip, $topic_id, $timestamp_actual));
        }
    } else {
        $add_view = $bdd->prepare('INSERT INTO forum_vues(user_ip, topic_id, timestamp_time) VALUES (?, ?, ?)');
        $add_view->execute(array($user_ip, $topic_id, $timestamp_actual));
    }
}

function get_nombre_de_vues($bdd, $topic_id){
    $nombre_vues = $bdd->prepare('SELECT vues_id FROM forum_vues WHERE topic_id = ?');
    $nombre_vues->execute(array($topic_id));
    $nombre_vues = $nombre_vues->rowCount();
    return $nombre_vues;
}

?>