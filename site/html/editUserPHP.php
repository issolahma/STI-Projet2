<?php
session_start();
include("Db.php");
$db = new DB();

if (!$_SESSION["isConnected"] || !$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}


if (isset($_POST['save'])) {

    $admin = isset($_POST['admin'])?1:0;
    $active = isset($_POST['inactive'])?0:1;
    
    $user = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Two requests because we don't have user data in form.
    $db->updateUser($user, $active, $admin);

    if (!empty($_POST['password'])) {
        $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $db->updatePassword($user, $hashedPwd);
    }

    header('location: index.php');
}
