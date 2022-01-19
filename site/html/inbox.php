<?php
include("Db.php");
session_start();
$db = new DB();

if (!$_SESSION["isConnected"]){
    header("Location: index.php");
    exit();
}

include('beforeTitle.php'); 
?>

<title>Mail box</title>
<?php include('afterTitle.php'); ?>
<li><a href="#">Mail Box</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
        <a href='index.php'>Home</a>
        <a href='logout.php'>Log out</a>
        <p></p>
    </div>
                <h2>Messages</h2>
                <div class="line-dec"></div>
                <span>All messages are listed here:</span>
            </div>
            <div class="right-image-post">
                <div class="row">

                    <div class="col-md-8">
                        <div class="left-text">

                            <table border="1">
                                <thead>
                                <th>Date</th>
                                <th>Sender</th>
                                <th>Object</th>
                                <th>Actions</th>
                                </thead>
                                <tbody>

                                <?php                                
                                printf($_SESSION['user_name']);
                                
                                //Get messages                                
                                $query = $db->getAllMessagesForUser($_SESSION['user_name']);
                                foreach($query as $row){
                                    echo "
					                <tr>
				    	            <td>".$row['datestamp']."</td>
					            	<td>".$row['sender_email']."</td>
					            	<td>".$row['object']."</td>
						  
					            	<td>
					        	    <a href='messageDetails.php' onclick=\"setCookie('msgId',".$row['id'].")\">Details</a>
                                 	<a href='addMessage.php' onclick=\"setCookie('email','".$row['sender_email']."')\">Reply</a>
					        		<a href='deleteMessage.php' onclick=\"setCookie('msgId',".$row['id'].")\">Delete</a>							
					            	</td> 
				                	</tr>";
                                }

                                ?>
                                </tbody>
                                </table>
</body>
<?php include('end.php'); ?>