<?php
$dbhost = "chatserverdb.cd3ixmxbmpj0.us-east-1.rds.amazonaws.com";
$dbport = 3306;
$dbname = "chatserverdb";
$db_username = "admin";
$db_password = "Quack1nce4^";

$username = $_POST['username'];
$password = $_POST['password'];
$salt = sha1($password);

echo($dbhost." ".$db_username." ".$db_password." ".$dbname." ".$dbport."<br>");

$conn = new mysqli($dbhost, $db_username, $db_password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users WHERE username=$username";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    //There is already a user with this user name
    header('Location: register-failed.php');
}

$query = "INSERT INTO users VALUES ($username, $password, $salt)";
$result = $conn->query($query);

$conn->close();


header('Location: register-success.php');
?>