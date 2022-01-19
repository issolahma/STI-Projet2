<!-- The users are not deleted but set as inactive -->
<?php
include("Db.php");
$db = new DB();
session_start();

if ($_SESSION['admin']){
    if (!empty($_COOKIE['email'])){
        $user = $_COOKIE['email'];
        $db->delUser($user);
    }
}

header('Location: getAllUsers.php');