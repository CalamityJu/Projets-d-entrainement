<?php
    //On cherche toutes les catégories

    $topics = get_topics($bdd, $categorie_id);
    $view_auth = get_view_auth($bdd, $categorie_id);
    var_dump ('view_auth = ' . $view_auth);
    die();

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
        $message = substr($message, 0, 50);
        echo $message;
    }

    function get_view_auth($bdd, $categorie_id){
        $req = $bdd->prepare('SELECT * FROM forum_forum WHERE forum_id = :categorie_id');
        $req->execute(array('categorie_id'=>$categorie_id));
        $data = $req->fetch();
        $req->closeCursor();
        return $data['view_auth'];
    }

    function read_aut($categorie_id){
        
    }
?>