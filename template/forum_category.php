<?php

    date_default_timezone_set('Europe/Paris');

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

    function get_last_message_time($bdd, $categorie_id){
        $date = new DateTime();
        $actual_date = strtotime($date->format('Y-m-d H:i:s'));
        
        //On récupère la date et l'id du dernier message posté dans la catégorie
        $req = $bdd->prepare('SELECT post_time FROM forum_post JOIN forum_topic ON post_topic_id = topic_id JOIN forum_forum ON topic_forum_id = forum_id WHERE forum_id = :categorie_id ORDER BY post_time DESC');
        $req->execute(array('categorie_id'=>$categorie_id));
        $data_post = $req->fetchAll();
        $req->closeCursor();
        if(!empty($data_post)){
            $last_post_date = strtotime($data_post[0]['post_time']);
        }

        $req = $bdd->prepare('SELECT topic_time FROM forum_topic JOIN forum_forum ON topic_forum_id = forum_id WHERE forum_id = :categorie_id ORDER BY topic_time DESC');
        $req->execute(array('categorie_id'=>$categorie_id));
        $data_topic = $req->fetchAll();
        $req->closeCursor();
        if(!empty($data_topic)){
            $last_topic_date = strtotime($data_topic[0]['topic_time']);
        }

        if(isset($last_topic_date)){
            if(isset($last_post_date)){
                if($last_post_date < $last_topic_date){
                    $diff= $actual_date - $last_topic_date;
                } else{
                    $diff= $actual_date - $last_post_date;
                }
            }else{
                $diff= $actual_date - $last_topic_date;
            }

        }

        if(isset($diff)){

            // Time difference in seconds 
            $sec     = $diff; 
            
            // Convert time difference in minutes 
            $min     = round($diff / 60 ); 
            
            // Convert time difference in hours 
            $hrs     = round($diff / 3600); 
            
            // Convert time difference in days 
            $days     = round($diff / 86400 ); 
            
            // Convert time difference in weeks 
            $weeks     = round($diff / 604800); 
            
            // Convert time difference in months 
            $mnths     = round($diff / 2600640 ); 
            
            // Convert time difference in years 
            $yrs     = round($diff / 31207680 ); 
            
            // Check for seconds 
            if($sec <= 60) { 
                return "$sec secondes"; 
            } 
            
            // Check for minutes 
            else if($min <= 60) { 
                if($min==1) { 
                    return "une minute"; 
                } 
                else { 
                    return "$min minutes"; 
                } 
            } 
            
            // Check for hours 
            else if($hrs <= 24) { 
                if($hrs == 1) {  
                    return "une heure"; 
                } 
                else { 
                    return "$hrs heures"; 
                } 
            } 
            
            // Check for days 
            else if($days <= 7) { 
                if($days == 1) { 
                    return "Hier"; 
                } 
                else { 
                    return "$days jours"; 
                } 
            } 
            
            // Check for weeks 
            else if($weeks <= 4.3) { 
                if($weeks == 1) { 
                    return "une semaine"; 
                } 
                else { 
                    return "$weeks semaines"; 
                } 
            } 
            
            // Check for months 
            else if($mnths <= 12) { 
                if($mnths == 1) { 
                    return "un mois"; 
                } 
                else { 
                    return "$mnths mois"; 
                } 
            } 
            
            // Check for years 
            else { 
                if($yrs == 1) { 
                    return "un an"; 
                } 
                else { 
                    return "$yrs ans"; 
                } 
            } 
        } 
        
    }
?>
