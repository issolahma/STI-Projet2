<?php
session_start();
include("Db.php");
$db = new DB();

if (!$_SESSION["isConnected"] || !$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}

include('beforeTitle.php');
?>

<title>Add user</title>
<?php include('afterTitle.php'); ?>
<li><a href="#">Add user</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
    <a href='index.php'>Home</a>
    <a href='logout.php'>Log out</a>
    <p></p>
</div>
<h2>Add user</h2>
<div class="line-dec"></div>
<span>You can add a new user </span>
</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                <form name="adduser" method="POST" action="addUserPHP.php">
                    <div>
                        <label> Email
                            <input type="text" name="email" placeholder="email" required />
                        </label>
                    </div>
                    <div>
                        <label> Password
                            <input type="password" name="password" placeholder="password" required />
                        </label>
                    </div>
                    <div>
                        <button type="submit"> Add User </button>
                    </div>
                </form>
                <?php include('end.php'); ?>