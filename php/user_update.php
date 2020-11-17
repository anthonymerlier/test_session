<?php

session_start();
if(!isset($_SESSION['email'])){
  // L'UTILISATEUR N'A PAS DE SESSION, ON LE REDIRIGE
  header("Location: login.php");
}

include("../connect.php");

if(isset($_POST['submitData'])){
    $prenom = !empty($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
    $nom = !empty($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;

    $reqUpdUserinfo = $bdd->prepare("UPDATE tb_users SET user_prenom = :user_prenom, user_nom = :user_nom WHERE user_email = :user_email");
    $reqUpdUserinfo->bindParam(":user_prenom", $prenom);
    $reqUpdUserinfo->bindParam(":user_nom", $nom);
    $reqUpdUserinfo->bindParam(":user_email", $_SESSION['email']);
    $reqUpdUserinfo->execute();
    
}
else{
    die();
}
