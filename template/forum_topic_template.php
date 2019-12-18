<?php
    //On cherche toutes les catégories

    $topics = get_topics($bdd, $categorie_id);
    $view_auth = get_auth($bdd, $categorie_id, "auth_view");
    $post_auth = get_auth($bdd, $categorie_id, "auth_post");
    $topic_auth = get_auth($bdd, $categorie_id, "auth_topic");
    $annonce_auth = get_auth($bdd, $categorie_id, "auth_annonce");

    //Toutes les fonctions

    /**
     * Fonction qui récupère tous les topics d'une catégorie défini
     */
    function get_topics($bdd, $categorie_id){
        $topics = [];
        $req = $bdd->prepare('SELECT * FROM forum_topic WHERE topic_forum_id = :categorie_id');
        $req->execute(array('categorie_id'=>$categorie_id));
        $rows = $req->fetchAll();
        $req->closeCursor();

        foreach($rows as $row){
            $topics[] = $row;
        }
        
        return $topics;
    }

    function get_begining_message($message){
        $message = substr($message, 0, 150);
        echo $message;
    }

    function get_categorie_title($bdd, $categorie_id){
        $req = $bdd->prepare('SELECT forum_title FROM forum_forum WHERE forum_id = :categorie_id');
        $req->execute(array('categorie_id' => $categorie_id));
        $data = $req->fetch();
        $req->closeCursor();
        return $data['forum_title'];
    }

    function get_auth($bdd, $categorie_id, $autorisation){
        $req = $bdd->prepare('SELECT * FROM forum_forum WHERE forum_id = :categorie_id');
        $req->execute(array('categorie_id'=>$categorie_id));
        $data = $req->fetch();
        return $data[$autorisation];
    }
?>