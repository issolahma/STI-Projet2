<?php
include("Db.php");
$db = new DB();
session_start();

print_r($_POST);
echo "<br/>";
print_r($_SESSION);
echo "<br/>";

if (!empty($_POST)) {
    $receiver = filter_var($_POST['receiver'], FILTER_SANITIZE_EMAIL);
    $sender = $_SESSION['user_name'];
    $object = filter_var($_POST['object'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $datestamp = date('Y-m-d');
    
    $result = $db->insertMessage($sender, $receiver, $object, $content, $datestamp);
    
    header('Location: inbox.php');
} else {
    header('Location: index.php');
}

print("end");
