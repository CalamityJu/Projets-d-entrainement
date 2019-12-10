<?php
    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    if(isset($_POST['membre_id']) && isset($_POST["nouveau_grade"]) && !empty($_POST['membre_id']) && !empty($_POST['nouveau_grade'])){
        echo "Youpi";
        //On cherche l'id du grade correspondant au slug choisi.
        $req =$bdd->prepare("SELECT id FROM roles WHERE slug = ?");
        $req->execute(array($_POST['nouveau_grade']));
        $donnees = $req->fetch(); 
        $req->closeCursor();
        $nouveau_grade_id = $donnees['id'];
        
        //On modifie l'id dans la table des membres
        $req = $bdd->prepare("UPDATE membres SET role_id = :nouveau_grade WHERE membre_id = :membre_id");
        $req->execute(array(
            'nouveau_grade' => $nouveau_grade_id,
            'membre_id' => $_POST['membre_id']
        ));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Aucun membre n'est sélectionné.";
    }
?>