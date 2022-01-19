<?php
include("Db.php");
$db = new DB();
session_start();


$pwd = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$newPwd = password_hash($pwd, PASSWORD_DEFAULT);
// Get user data if exists and active.
$user = $db->getActiveUserByMail($_SESSION['user_name']);

if ($user) {
    // Compare user imput for current password with hash from db.
    $validePwd = password_verify($_POST['cPass'], $user[0]['password']);

    if ($validePwd) {
        print_r($user);
        printf("<br/> newPWD: ".$newPwd);
        // Set new password
        $db->updatePassword($user[0]['email'], $newPwd);
        //header('Location: index.php');
    } else {
        $_SESSION['error'] = true;
        header('Location: changePass.php');
    }
}
