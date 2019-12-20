<?php 
    $posts = get_posts($bdd, $categorie_id);

function get_posts($bdd, $topic_id){
    $posts = [];
    $req = $bdd->prepare('SELECT * FROM forum_post JOIN membres ON post_member_id = membre_id WHERE post_topic_id = :topic_id');
    $req->execute(array('topic_id'=>$topic_id));
    $rows = $req->fetchAll();
    $req->closeCursor();

    foreach($rows as $row){
        $posts[] = $row;
    }
    
    return $posts;
}

function get_topic_title($bdd, $topic_id){
    $req = $bdd->prepare('SELECT topic_title FROM forum_topic WHERE topic_id = :topic_id');
    $req->execute(array('topic_id' => $topic_id));
    $data = $req->fetch();
    $req->closeCursor();
    return $data['topic_title'];
}

?>