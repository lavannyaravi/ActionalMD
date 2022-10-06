<?php
include_once 'config.php';
include_once 'base.php';

//Checking if the admin is authorized
session_start();
session_regenerate_id();
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
    exit();
}

//getting id from the url and this id's data
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_array($query);

//Displaying user's information
?>

<html>
<head>
	<title><?php $username?></title>
</head>

<body>
	<a href="index.php">Go back</a><br/><br/>

    <table>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Password</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Gender</td>
            <td>Birth date</td>
            <td>Update</td>
        </tr>
        <tr>
        <?php 		
            echo "<td>".$user['id']."</td>";
            echo "<td>".$user['username']."</td>";
            echo "<td>".$user['password']."</td>";
            echo "<td>".$user['first_name']."</td>";
            echo "<td>".$user['last_name']."</td>";
            echo "<td>".$user['gender']."</td>";
            echo "<td>".$user['birth_date']."</td>";
            echo "<td><a href=\"edit.php?id=$user[id]\">Edit</a> <a href=\"delete.php?id=$user[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       
        ?>
        </tr>
    </table>
</body>
</html>