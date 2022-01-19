<?php
session_start();
include("Db.php");
$db = new DB();

if (!$_SESSION["isConnected"]) {
    header("Location: index.php");
    exit();
}


include('beforeTitle.php');
?>

<title>Send message</title>
<?php include('afterTitle.php'); ?>
<li><a href="#">Send message</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
    <a href='index.php'>Home</a>
    <a href='logout.php'>Log out</a>
    <p></p>
</div>

<?php 
$receiver = $_COOKIE['email']; 
?>

<h2>Send Message</h2>
<div class="line-dec"></div>
<span>You can write your message here: </span>
</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                <form name="addMessage" method="POST" action="addMessagePHP.php">
                    <div>
                        <label> TO :
                            <input type="text" name="receiver" placeholder="" value="<?php echo $receiver ?>" />
                        </label>
                    </div>
                    <div>
                        <label> Object :
                            <input type="text" name="object" />
                        </label>
                    </div>
                    <div>
                        <label> Content:</label>
                        <textarea type="text" name="content"></textarea>

                    </div>
                    <div>
                        <button type="submit"> Send </button>
                    </div>
                </form>

                </body>
<?php 
include('end.php'); 
?>