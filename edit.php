<?php
include_once 'config.php';
include_once 'base.php';
include_once 'functions.php';

//Checking if the admin is authorized
session_start();
session_regenerate_id();
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
	exit();
}

//Edit form submitted:
if(isset($_POST['update'])) { 
	$id = $_POST['id'];
	$oldusername = $_POST['oldusername'];
	$username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];

	//Validating input data

	if (emptyInput($username, $password, $first_name, $last_name, $gender, $birth_date)) {
		header("Location: edit.php?id=$id&error=emptyinput");
		exit();
	}

	if (invalidUsername($username)) {
		header("Location: edit.php?id=$id&error=invalidusername");
		exit();
	}

	if ($oldusername !== $username) {
		if (usernameTaken($conn, $username)) {
			header("Location: edit.php?id=$id&error=usernametaken");
			exit();
		}
	}
	
	if (invalidPassword($password)) {
		header("Location: edit.php?id=$id&error=invalidpassword");
		exit();
	}
	
	if (invalidName($first_name, $last_name)) {
		header("Location: edit.php?id=$id&error=invalidname");
		exit();
	}
	
	if (invalidDate($birth_date)) {
		header("Location: edit.php?id=$id&error=invaliddate");
		exit();
	}
    
	//updating information if all fields are filled in correctly
    $query = mysqli_query($conn, "UPDATE users SET username='$username', password='$password', first_name='$first_name',
									last_name='$last_name', gender='$gender', birth_date='$birth_date' WHERE id=$id");

    header("Location: index.php");
	exit();
}

//getting id from the url and this id's data
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_array($query);

$username = $user['username'];
$password = $user['password'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$gender = $user['gender'];
$birth_date = $user['birth_date'];


//edit form
?>

<html>
<head>
	<title>Edit User Information</title>
</head>

<body>
	<a href="index.php">Back to main</a><br/><br/>

    <form method="POST" action="edit.php" name="edit_form">
		<table>
			<tr> 
				<td>Username</td>
				<td><input type="text" name="username" value="<?php echo $username;?>"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password" value="<?php echo $password;?>"></td>
			</tr>
			<tr> 
				<td>First Name</td>
				<td><input type="text" name="first_name" value="<?php echo $first_name;?>"></td>
			</tr>
			<tr> 
				<td>Last Name</td>
				<td><input type="text" name="last_name" value="<?php echo $last_name;?>"></td>
			</tr>
			<tr> 
				<td>Gender</td>
				<td>
                    <input type="radio" name="gender" value="male" <?php echo($gender=='male')?'checked':''?> id="r1">
                    <label for 'r1'>male</label>
                    <input type="radio" name="gender" value="female" <?php echo($gender=='female')?'checked':''?> id="r2">
                    <label for 'r2'>female</label>
                    <input type="radio" name="gender" value="other" <?php echo($gender=='other')?'checked':''?> id="r3">
                    <label for 'r3'>other</label>
                </td>
			</tr>
			<tr> 
				<td>Birth Date</td>
				<td><input type="date" name="birth_date" value="<?php echo $birth_date;?>"></td>
			</tr>
			<tr> 
				<td><input type="hidden" name="id" value=<?php echo $id;?>>
					<input type="hidden" name="oldusername" value=<?php echo $username;?>>
				</td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>