<?php
  // On démarre la session
  session_start();

  $id= $_SESSION['id'];

  // On se connecte à la bdd
  try {
    $bdd= new PDO('mysql:host=localhost; dbname=espacemembre; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  } 

  if(isset($_POST['description'])) {
    $description = htmlspecialchars($_POST['description']);
    $_SESSION['description'] = $description;
  }
  if(isset($_POST['signature'])) {
    $signature = htmlspecialchars($_POST['signature']);
    $_SESSION['signature'] = $signature;
  }

  if(isset($description) || isset($signature)){
    $req = $bdd->prepare("UPDATE membres SET membre_description = :nvlle_description, membre_signature = :nvlle_signature WHERE membre_id = :id");
    $req->execute(array(
      'nvlle_description' => $description,
      'nvlle_signature' => $signature,
      'id' => $id
    ));
    $req->closeCursor();
    echo "C'est bon";
  }

?>