<?php



if(isset($_POST['submitConnect'])){

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if($email === false){
        echo "Ce n'est pas un email";
        die();
    }

    include("../connect.php");

    $reqVerifEmail = $bdd->prepare("SELECT * FROM tb_users WHERE user_email = ? LIMIT 1");
    $reqVerifEmail->execute([ $email ]);
    $dataUser =$reqVerifEmail->fetch();

    $emailDB = $dataUser['user_email'];
    $passDB = $dataUser['user_passwd'];
    $passSendForm = $_POST['pass'];

    if(password_verify($passSendForm, $passDB)){
        // LES MDP CORRESPONDENT

        session_start();
        $_SESSION['email'] = $emailDB;

        header("Location: ../dashboard.php");

    }
    else{
        // CORRESPONDENT PAS
        echo "Erreur, les mdp ne correspondent pas";
        die();
    }


}else{
    echo "Erreur !";
    die();
}