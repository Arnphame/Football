<?php

include '../class/user.php';
$user = new user();

session_start();
$email = $_POST['email'];

if(empty($email)) {
    $_SESSION['error'] = "Email is empty. Please fill this field.";
    header("Location:../form/user_forgot_password.php");
}

else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = 'Please enter a valid email address.';
        header("Location:../form/user_forgot_password.php");
    }
else{
    $set_token = $user->set_token($email);
    if($set_token){
        $_SESSION['success'] = "Password reset success. Email has been sent.";
        $_SESSION['error'] = "";
        header("Location:../form/index.php");
    }
    else{
        $_SESSION['error'] = "Email doesn't exist.";
        header("Location:../form/user_forgot_password.php");
    }
}
