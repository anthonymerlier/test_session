<?php

$dsn = 'mysql:dbname=test_session;host=localhost';
$user = 'root';
$password = '';


try {
    $bdd = new PDO($dsn, $user, $password);
}
catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}