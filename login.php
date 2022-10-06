<?php
include_once 'config.php';
include_once 'base.php';
include_once 'functions.php';

//Log in form submitted:
if (isset($_POST['login'])) {	
	$username = $_POST['username'];
	$password = $_POST['password'];

	//Validating input data
	if (emptyInputLogin($username, $password)) {
		header("Location: login.php?error=emptyinput");
		exit();
	}
	
	if (wrongUsername($conn, $username)) {
		header("Location: login.php?error=wrongusername");
		exit();
	} 
	
	if (wrongPassword($conn, $username, $password)) {
		header("Location: login.php?error=wrongpassword");
		exit();
	}

	//Authorizing admin
	session_start();
	$_SESSION['loggedin'] = true;
    header("Location: index.php");
	exit();
}

//Log in form:
?>

<html>
<head>
	<title>Log in</title>
</head>


<!DOCTYPE html>
<html>

<head>

<title> Log-in Admin</title>
<link rel="stylesheet"  href="assets/css/style.css">
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

	
</head>

<body>

<form method="POST" action="login.php" name="add_form">
	<div class="loginbox">
		<img class="img" src="uploads/avatar.svg">
		<h2 class="title">LOGIN ADMIN</h2>
	
	<div class="containar">
	<div class="fillbox" >
		<i class="fas fa-user"></i>
		<input  type="text" placeholder="username" name="username">
	</div>
	   
  
  	<div class="fillbox">
		<i class="fas fa-lock"></i>
		<input type="password" placeholder="password" name="password">
	</div>
	</div>

    <div class="button">
    	<input class="btn" type="submit"  name="login"  value="Login">
	</div>
	

	</form>
	</div>





</body>
</html>