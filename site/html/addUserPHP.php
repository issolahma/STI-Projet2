<?php
session_start();
include("Db.php");
$db = new DB();

if (!$_SESSION["isConnected"] || !$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

// check if user already exists
$result = $db->getRoleByEmail($email);

if (!empty($result)) {
    // Create active user with user role
    $db->createUser($email, $hashedPwd, 1, 0);
}
                    