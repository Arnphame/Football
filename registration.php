<?php
    include 'class/user.php';
    session_start();
    $user = new user();
    if(isset($_REQUEST['submit'])){
        $name = $_POST['login'];
        $password = $_POST['pass'];
        $password2 = $_POST['pass2'];
        if($password != $password2){
            $_SESSION['saved name'] = $name;
            $_SESSION['error'] = "Passwords do not match.";
            header("Location:user_register.php");
        }
        else if(empty($name)){
            $_SESSION['error'] = "User name is empty. Please fill all the fields.";
            header("Location:user_register.php");
        }
        else
        {
            $register = $user->user_registration($name, $password);
            if($register) {
                $_SESSION['success'] = "Registration was successfull. You're automatically logged in";
                $_SESSION['error'] = "";
                $user->user_login($name,$password);
                header("Location:index.php");
            }
            else {
                $_SESSION['error'] = "User name already exists.";
                header("Location:user_register.php");
            }
        }
    }
?>