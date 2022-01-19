<?php
include("Db.php");
$db = new DB();
session_start();

if (isset($_SESSION)){
        $id = $_COOKIE['msgId'];
        $_COOKIE['msgId'] = "";
        
        $result = $db->delMessage($id);
       
        if ($result){
            header("Location: inbox.php" );
        }
        header("Location: index.php" );
}
