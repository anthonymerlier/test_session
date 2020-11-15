<?php

session_start();
//unset($_SESSION['email']);
$_SESSION['email'] = null;
session_destroy();
header("Location: login.php");