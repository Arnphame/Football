<?php
session_start();
include '../class/user.php';
$user = new user();
header("Location:../form/index.php");
$user->user_logout();
?>