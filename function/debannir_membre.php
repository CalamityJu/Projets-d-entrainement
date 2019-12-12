<?php
    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    if(isset($_POST['membre_id']) && !empty($_POST['membre_id'])){
        $id_a_debannir = $_POST['membre_id'];

        //On cherche l'id du grade membre
        $req = $bdd->query('SELECT id FROM roles WHERE slug="member"');
        $donnees = $req->fetch();
        $id_du_grade_membre = $donnees['id'];
        $req->closeCursor();

        //On change le grade du membre dans la base de donnée
        $req = $bdd->prepare('UPDATE membres SET role_id = :grade_membre WHERE membre_id = :membre_id');
        $req->execute(array(
            'grade_membre'=> $id_du_grade_membre,
            'membre_id'=> $id_a_debannir
        ));
        $req->closeCursor();

        // On supprime le membre de la table des bannis
        $req = $bdd->prepare('DELETE FROM membres_bannis WHERE banni_id = ?');
        $req->execute(array($id_a_debannir));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Aucun membre n'est sélectionné.";
    }
?>