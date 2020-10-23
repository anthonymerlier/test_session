<?php

if(isset($_POST['submitBtn'])){
    // RECUPERATION ET VERIFICATION DE L'EMAIL
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if($email == false){
        echo "Erreur";
        die();
    }

    // VERIFICATION DES PASSWORD
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
    if($password != $confirmPassword){
        echo "Les mots de passe ne sont pas identiques";
        die();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    // $confirmPasswordHash = password_hash($confirmPassword, PASSWORD_DEFAULT);

    include("../connect.php");
    $req = $bdd->prepare("INSERT INTO tb_users (user_email, user_passwd) VALUES (:user_email, :user_passwd)");
    $req->bindParam(":user_email", $email);
    $req->bindParam(":user_passwd", $passwordHash);
    $req->execute();

    header("Location: ../index.php?register=success");




}else{
    echo "Vous n'avez pas le droit de faire ceci";
}





//var_dump($email);