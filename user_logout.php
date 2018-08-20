<?php
session_start();
include 'class/user.php';
$user = new user();
header("Location:index.php");
$user->user_logout();
?>