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

//Add form submitted:
if(isset($_POST['submit'])) {	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$gender = $_POST['gender'];
	$birth_date = $_POST['birth_date'];

    //Validating input data

    if (emptyInput($username, $password, $first_name, $last_name, $gender, $birth_date)) {
		header("Location: add.php?error=emptyinput");
		exit();
	}

	if (invalidUsername($username)) {
		header("Location: add.php?error=invalidusername");
		exit();
	}

	if (usernameTaken($conn, $username)) {
		header("Location: add.php?error=usernametaken");
		exit();
	}
	
	if (invalidPassword($password)) {
		header("Location: add.php?error=invalidpassword");
		exit();
	}
	
	if (invalidName($first_name, $last_name)) {
		header("Location: add.php?error=invalidname");
		exit();
	}
	
	if (invalidDate($birth_date)) {
		header("Location: add.php?error=invaliddate");
		exit();
	}
	
    //Inserting new user if all fields are filled in correctly 
    $query = mysqli_query($conn, "INSERT INTO users(username,password,first_name,last_name,gender,birth_date) VALUES('$username','$password','$first_name','$last_name','$gender','$birth_date')");
    header("Location: index.php");
    exit();
	
}

//Add form
?>

<html>
<head>
	<title>Add User</title>
</head>

<body>
	<a href="index.php">Back to main</a><br/><br/>

	<form method="POST" action="add.php" name="add_form">
		<table>
			<tr> 
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>First Name</td>
				<td><input type="text" name="first_name"></td>
			</tr>
			<tr> 
				<td>Last Name</td>
				<td><input type="text" name="last_name"></td>
			</tr>
			<tr> 
				<td>Gender</td>
				<td>
                    <input type="radio" name="gender" value="male" id="r1">
                    <label for 'r1'>male</label>
                    <input type="radio" name="gender" value="female" id="r2">
                    <label for 'r2'>female</label>
                    <input type="radio" name="gender" value="other" id="r3">
                    <label for 'r3'>other</label>
                </td>
			</tr>
			<tr> 
				<td>Birth Date</td>
				<td><input type="date" name="birth_date"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="submit" value="Add"></td>
			</tr>
		</table>
	</form>
</body>
</html>