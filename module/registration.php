<?php
    include '../class/user.php';
    session_start();
    $user = new user();
    if(isset($_REQUEST['submit'])){
        $name = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $password2 = $_POST['pass2'];
        if($password != $password2){
            $_SESSION['saved name'] = $name;
            $_SESSION['error'] = "Passwords do not match.";
            header("Location:../form/user_register.php");
        }
        else if(empty($name)){
            $_SESSION['error'] = "User name is empty. Please fill all the fields.";
            header("Location:../form/user_register.php");
        }
        else if(empty($email)){
            $_SESSION['error'] = "Email is empty. Please fill all the fields.";
            header("Location:../form/user_register.php");
        }
        else if(strlen($_POST['login']) < 3){
            $_SESSION['error'] = 'Username is too short. Must be atleast 3 characters.';
            header("Location:../form/user_register.php");
            }
        else if(strlen($_POST['pass']) < 3){
            $_SESSION['error'] = 'Password is too short. Must be atleast 3 characters';
            header("Location:../form/user_register.php");
        }
        else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'Please enter a valid email address.';
            header("Location:../form/user_register.php");
        }
        else if(!$user->check_availability($name)){
            $_SESSION['error'] = "User name already exists.";
            header("Location:../form/user_register.php");
        }
        else if($user->check_email($email)){
            $_SESSION['error'] = "Email already exists.";
            header("Location:../form/user_register.php");
        }
        else  {
            $register = $user->user_registration($name, $email, $password);
            $_SESSION['success'] = "Registration was successfull. You're automatically logged in";
            $_SESSION['error'] = "";
            $user->user_login($name,$password);
            header("Location:../form/index.php");}
    }
?>