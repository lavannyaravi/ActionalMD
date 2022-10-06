<?php
//Describing error messages
include_once 'functions.php';

if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p>You should fill in all fields";
    }
    
    if ($_GET["error"] == "usernametaken") {
        echo "<p>Username is already taken";
    }

    if ($_GET["error"] == "wrongusername") {
        echo "<p>Wrong username";
    }

    if ($_GET["error"] == "wrongpassword") {
        echo "<p>Wrong password";
    }

    if ($_GET["error"] == "invalidusername") {
        echo "<p>Invalid username. You should use only letters and numbers. Maximum length is 50.";
    }
    
    if ($_GET["error"] == "invalidpassword") {
        echo "<p>Invalid password. You should use only letters and numbers. Maximum length is 50.";
    }
    
    if ($_GET["error"] == "invalidname") {
        echo "<p>Invalid name. You should use only letters. Maximum length is 20.";
    }
    
    if ($_GET["error"] == "invaliddate") {
        echo "<p>Invalid birth date";
    }
}

//Base style:
?>

<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 14px;
        width: 50%
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>