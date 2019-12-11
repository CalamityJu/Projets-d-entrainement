<?php
    // On se connecte à la bdd
    try {
        $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } 

    if(isset($_POST['membre_id']) && !empty($_POST['membre_id'])){
        $id_a_bannir = $_POST['membre_id'];
        //On récupère le membre dans la base de donnée
        $req = $bdd->prepare('SELECT membre_pseudo, membre_email FROM membres WHERE membre_id = ?');
        $req->execute(array($_POST['membre_id']));
        $donnees = $req->fetch();
        $pseudo_a_bannir = $donnees['membre_pseudo'];
        $email_a_bannir = $donnees['membre_email'];
        $req->closeCursor();

        // On ajoute le membre à la table des bannis
        $req = $bdd->prepare('INSERT INTO membres_bannis (banni_id, banni_pseudo, banni_mail) VALUES (:banni_id, :banni_pseudo, :banni_mail)');
        $req->execute(array(
            'banni_id'=> $id_a_bannir,
            'banni_pseudo'=>$pseudo_a_bannir,
            'banni_mail'=>$email_a_bannir
        ));
        $req->closeCursor();

        //On récupère l'id du rang banni
        $req = $bdd->query('SELECT id FROM roles WHERE slug="ban"');
        $ban_id = $req->fetch();
        $ban_id = $ban_id['id'];
        //On change le grade en banni
        $req = $bdd->prepare('UPDATE membres SET role_id = :grade_banni WHERE membre_id = :membre_id');

        $req->execute(array(
            'grade_banni' => $ban_id,
            'membre_id' => $id_a_bannir
        ));
        $req->closeCursor();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        die();
    } else {
        echo "Aucun membre n'est sélectionné.";
    }
?>