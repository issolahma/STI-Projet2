<?php
    session_start();
    include("Db.php");
    $db = new DB();

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Sanatisation of user input. 
        // Not needed for the password, because it's not sent to the db.
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        // Get user data if exists and active.
        $user = $db->getActiveUserByMail($email);

        if (empty($user)) {
            // Add sleep to simulate password validation.
            sleep(1);
        } else {
            // Compare user imput with hash from db.
            $valideUser = password_verify($_POST['password'], $user[0]['password']);
        }
        if ($valideUser) {
            $_SESSION['isConnected'] = true;
            $_SESSION['conFailed'] = false;
            $_SESSION['user_name']=$user[0]['email'];
            $_SESSION['admin']=$user[0]['admin'];
            $_SESSION['active']=1;
            header('Location: index.php');
        } else {
            $_SESSION['conFailed'] = true;
            header('Location: login.php');
        }
}
