<?php
    //On cherche toutes les catégories

    $categories = get_categories($bdd);



    //Toutes les fonctions
    function get_categories($bdd){
        $categories = [];
        $rows = $bdd->query('SELECT * FROM forum_forum');

        foreach($rows as $row){
            $categories[] = $row;
        }
        
        return $categories;
    }
?>
