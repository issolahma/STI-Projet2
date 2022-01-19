<?php
include("Db.php");
session_start();
$db = new DB();

if (!$_SESSION["isConnected"] || !$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}

include('beforeTitle.php');
?>

<title>Display all users</title>
<?php include('afterTitle.php'); ?>
<li><a href="#">Users</a></li>
<?php include('afterSection.php'); ?>
<div class="white-button">
    <a href='index.php'>Home</a>
    <a href='logout.php'>Log out</a>
    <p></p>
</div>

<h2>Users</h2>
<div class="line-dec"></div>
<span>All users are listed here:</span>
</div>
<div class="right-image-post">
    <div class="row">

        <div class="col-md-8">
            <div class="left-text">

                <table border="1">
                    <thead>
                        <th>email</th>
                        <th>Send a message</th>
                        <th>Administrator state</th>
                        <th>Active status</th>
                        <th>Actions</th>

                    </thead>
                    <tbody>

                        <?php
                        $users = $db->getAllUser();

                        foreach ($users as $row) {
                            echo "
					                <tr>
						            <td>" . $row['email'] . "</td>
						            <td><a href='addMessage.php' onclick=\"setCookie('email','".$row['email']."')\">Send Message </a></td>
                                    <td>" . $row['admin'] . "</td>
						            <td>" . $row['active'] . "</td>
							        <td><a href='editUser.php' onclick=\"setCookie('email','".$row['email']."')\">Edit</a>
							        <a href='deleteUser.php' onclick=\"setCookie('email','".$row['email']."')\">Delete</a>											
						            </td>
					                </tr>";
                        } ?>
                    </tbody>
                </table>


                <div class="white-button">
                    <button color="red"><a href='addUser.php'>Add new user</a></button>
                </div>

                <?php include('end.php'); ?>