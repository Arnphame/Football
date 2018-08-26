<?php

include '../class/user.php';
$user = new user();

session_start();
$login = $_POST['login'];
$pass = $_POST['pass'];

if(empty($login)){
    $_SESSION['error'] = "User name is empty. Please fill all the fields.";
    header("Location:../form/user_login.php");
}
else{
    $auth = $user->user_login($login, $pass);
    if($auth){
        header("Location:../form/index.php");
    }
    else{
        $_SESSION['error'] = "User name or password is not correct.";
        header("Location:../form/user_login.php");
    }
}
