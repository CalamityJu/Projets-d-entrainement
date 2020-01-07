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
        return $message;
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

    function get_member_info($bdd, $topic_id){
        
    }

    function get_last_post_time($bdd, $topic_id){
        $date = new DateTime();
        $actual_date = strtotime($date->format('Y-m-d H:i:s'));
        
        //On récupère la date et l'id du dernier message posté dans le topic
        $req = $bdd->prepare('SELECT post_time FROM forum_post JOIN forum_topic ON post_topic_id = topic_id WHERE topic_id = :topic_id ORDER BY post_time DESC');
        $req->execute(array('topic_id'=>$topic_id));
        $data_message = $req->fetchAll();
        $req->closeCursor();
        if(!empty($data_message)){
            $last_message_date = strtotime($data_message[0]['post_time']);
            $diff_message = $actual_date - $last_message_date;
        }


        $req = $bdd->prepare('SELECT topic_time FROM forum_topic WHERE topic_id = :topic_id ORDER BY topic_time DESC');
        $req->execute(array('topic_id'=>$topic_id));
        $data_topic = $req->fetchAll();
        $req->closeCursor();
        if(!empty($data_topic)){
            $last_topic_date = strtotime($data_topic[0]['topic_time']);
        }

        if(isset($last_topic_date)){
            if(isset($last_message_date)){
                if($last_message_date < $last_topic_date){
                    $diff= $actual_date - $last_topic_date;
                } else{
                    $diff= $actual_date - $last_message_date;
                }
            }else{
                $diff_message= $actual_date - $last_topic_date;
            }

        }


        if(isset($diff_message)){

            // Time difference in seconds 
            $sec     = $diff_message; 
            
            // Convert time difference in minutes 
            $min     = round($diff_message / 60 ); 
            
            // Convert time difference in hours 
            $hrs     = round($diff_message / 3600); 
            
            // Convert time difference in days 
            $days     = round($diff_message / 86400 ); 
            
            // Convert time difference in weeks 
            $weeks     = round($diff_message / 604800); 
            
            // Convert time difference in months 
            $mnths     = round($diff_message / 2600640 ); 
            
            // Convert time difference in years 
            $yrs     = round($diff_message / 31207680 ); 
            
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

    function get_number_messages($bdd, $topic_id){
        $req = $bdd->prepare('SELECT COUNT(*) FROM forum_post JOIN forum_topic ON post_topic_id = topic_id WHERE topic_id = :topic_id');
        $req->execute(array('topic_id'=>$topic_id));
        $number_message = $req->fetchAll();
        $req->closeCursor();
        if(!empty($number_message)){
            return($number_message[0][0]);
        }
    }
?>