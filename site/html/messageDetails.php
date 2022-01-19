<html>
<?php
session_start();
include("Db.php");
$db = new DB();

if (!$_SESSION["isConnected"]){
    header("Location: login.php");
    exit();
}

include('beforeTitle.php'); 

?>
    <title>Message details</title>
    <?php include('afterTitle.php'); ?>
    <li><a href="#section1">Message details</a></li>
    <?php include('afterSection.php'); ?>
    <div class="white-button">
        <a href='index.php'>Home</a>
        <a href='logout.php'>Log out</a>
        <p></p>
    </div>
    <h2>Details du message</h2>
    <div class="line-dec"></div>
    <span>Détails et actions</span>

    <div>
        <?php
        $id = $_COOKIE['msgId']; 
        $query = $db-> getMessageById($id);

        foreach($query as $row) {
            echo "
                <table border='2'>
                     <thead>
                                <th>Date</th>
                                <th>Sender</th>
                                <th>Object</th>
                                <th>Content</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>

					<tr>
				    	<td>" . $row['datestamp'] . "</td>  	
						<td>" . $row['sender_email'] . "</td>
						<td>" . $row['object'] . "</td>
						<td>".$row['content']."</td>
						  
						<td>
                        <a href='addMessage.php' onclick=\"setCookie('email','".$row['sender_email']."')\">Reply</a>
                        <a href='deleteMessage.php' onclick=\"setCookie('email','".$row['sender_email']."')\">Delete</a>
							
						</td>
					</tr>
					</tbody>
					</table>
				";
        }
        ?>
    </div>
<?php include('end.php'); ?>
