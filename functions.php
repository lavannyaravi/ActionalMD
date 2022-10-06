<?php
include_once 'base.php';
include_once 'config.php';

//checks if the login input is empty
function emptyInputLogin($username, $password) {
    if (empty($username) || empty($password)) {
        return true;
    }
    return false;
}

//checks if the user's login is wrong
function wrongUsername($conn, $username) {
    $query = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");

    if (mysqli_num_rows($query) > 0) {
        return false;
    }
    return true;
}

//checks if the user's password is wrong
function wrongPassword($conn, $username, $password) {
    $query = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
    $user = mysqli_fetch_array($query);

    if ($password === $user['password']) {
        return false;
    } 
    return true;
}

//checks if any of the fields doesn't fill in
function emptyInput($username, $password, $first_name, $last_name, $gender, $birth_date) {
    if (empty($username) || empty($password) || empty($first_name) || empty($last_name) || empty($gender) || empty($birth_date)) {
        return true;
    }
    return false;
}

//checks if the username is taken
function usernameTaken($conn, $username) {
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}

//checks if the username is invalid
function invalidUsername($username) {
    if (!preg_match("/^[a-zA-Z0-9]{1,100}$/", $username)) {
        return true;
    }
    return false;
}

//checks if the password is invalid
function invalidPassword($password) {
    if (!preg_match("/^[a-zA-Z0-9]{1,50}$/", $password)) {
        return true;
    }
    return false;
}


//checks if the name is invalid
function invalidName($first_name, $last_name) {
    if (!preg_match("/^[A-Z][a-z]{1,19}$/", $first_name) || !preg_match("/^[A-Z][a-z]{1,19}$/", $last_name)) {
        return true;
    }
    return false;
}

//checks if the year is invalid
function invalidDate($birth_date) {
    $year = substr($birth_date, 0, 4);

    if (intval($year) < 1900 || intval($year) > 2020) {
        return true;
    }
    return false;
}
