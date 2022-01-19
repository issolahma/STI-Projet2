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

<title>Edit user</title>
<?php include('afterTitle.php'); ?>
<li><a href="#section1">Edit user</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
    <a href='index.php'>Home</a>
    <a href='logout.php'>Log out</a>
    <p></p>
</div>
<h2>Edit User <?php echo $_COOKIE['email'] ?></h2>
<div class="line-dec"></div>
<span>You can make your changes here </span>
</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                
                <form name="editUser" method="POST" action="editUserPHP.php">
                    <label>New Password:</label>
                    <input type="password" id="password" name="password" placeholder="new pass" />

                    <p><label>Role admin</label>
                        <input type="radio" name="admin" value="1">
                    </p>
                    
                    <p><label>Deactivate user</label>
                        <input type="radio" name="inactive" value="0">
                    </p>
                    <input type="submit" name="save" value="Save">
                    <input type="hidden" name="email" value="<?php echo $_COOKIE['email'] ?>">
                </form>

            </div>
            <?php include('end.php'); ?>