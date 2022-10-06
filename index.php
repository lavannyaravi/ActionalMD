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

//Page settings:
$rows_per_page = 10;
$query = mysqli_query($conn, "SELECT * FROM Users"); 
$rows_num = mysqli_num_rows($query);
$pages_num = ceil($rows_num / $rows_per_page);

//Getting/setting current page number
if (isset($_GET['p'])) {
    $cur_page = $_GET['p'];
} else {
    $cur_page = 1;
}
    

?>

<style>
    tr:nth-child(even){
        background-color: #dddddd;
    }
</style>

<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <a href="add.php">Add User</a><br/>
    <a href="logout.php">Log out</a><br/><br/>

    <?php
    //Displaying pages:
    for ($i = 1; $i < $pages_num + 1; $i++) {
        if ($i != $cur_page) {
            echo '<a href="index.php?p='.$i.'">'.$i.'</a> ';
        } else {
            echo $i;
        }
    }

    //Selecting users to show on current page
    $from = $cur_page * $rows_per_page - $rows_per_page;
    $to = $cur_page * $rows_per_page;
    $query = mysqli_query($conn, "SELECT * from users ORDER by id asc limit $from, $to");
    ?>
    <br/><br/>
	

    <?php //Displaying users table ?>
    <table>
	
	
	
	
    <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Name</td>
		<td>Gender</td>
		<td>Join Date</td>
        <td>Update</td>
    </tr>
			
	
    <?php 
    while($user = mysqli_fetch_array($query)) { 		
        echo "<tr>";
        echo "<td>".$user['id']."</td>";
        echo "<td><a href=\"user.php?id=$user[id]\">".$user['username']."</a></td>";
        echo "<td>".$user['first_name'].' '.$user['last_name']."</td>";	
		echo "<td>".$user['gender']."</td>";	
		echo "<td>".$user['birth_date']."</td>";
        echo "<td><a href=\"edit.php?id=$user[id]\">Edit</a> <a href=\"delete.php?id=$user[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       
    }
    ?>
    </table>




