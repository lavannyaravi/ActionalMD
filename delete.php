<?php
include "config.php";

//Checking if the admin is authorized
session_start();
session_regenerate_id();
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
    exit();
}

//Getting row id from the url and deleting this row
$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM users WHERE id=$id");

//Redirecting back
header("Location: index.php");
exit();
?>