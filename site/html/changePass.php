<?php
session_start();

if (!$_SESSION["isConnected"]) {
    header("Location: index.php");
    exit();
}

include('beforeTitle.php');
?>

<title>Change Pass</title>
<?php include('afterTitle.php'); ?>
<li><a href="#">Change Pass</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
    <a href='index.php'>Home</a>
    <a href='logout.php'>Log out</a>
    <p></p>
</div>

<h2>Change your password</h2>
<div class="line-dec"></div>
<span>You can change your password </span>
</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                <?php
                if ($_SESSION['error']) {
                    echo "<p style=\"color:red; font-weight: bold;\">Error</p>";
                }
                ?>
                <div>
                    <form action="changePassPHP.php" method="post">
                        <label> Current password
                            <input type="text" name="cPass" />
                        </label>
                </div>
                <div>
                    <label> New password
                        <input type="password" name="password" />
                    </label>
                </div>

                <div>
                    <button type="submit" value="Sum" name="Submit1"> Change Pass</button>
                </div>
                </form>

                <?php
                $_SESSION['error'] = false;
                include('end.php');
                ?>