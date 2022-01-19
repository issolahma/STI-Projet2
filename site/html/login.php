<?php 
session_start();
include('beforeTitle.php'); 
?>

<title>Sign in</title>
<?php include('afterTitle.php'); ?>
<li><a href="#section1">Sign in</a></li>
<?php include('afterSection.php'); ?>

<h2><?php echo "Sign in"; ?></h2>
<div class="line-dec"></div>
<span>Please, enter your password and email</span>

</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                <form name="login" method="POST" action="loginPHP.php">
                    <?php
                    if ($_SESSION['conFailed']) {
                        echo "<p style=\"color:red; font-weight: bold;\">Error in credentials</p>";
                    }
                    ?>
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
                        <button type="submit"> Login </button>
                    </div>
                </form>
<?php 
include('end.php'); 
$_SESSION['conFailed'] = false;
?>